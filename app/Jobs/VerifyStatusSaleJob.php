<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Sale;
use Illuminate\Support\Facades\Http;

class VerifyStatusSaleJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Sale $sale)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::upmidias()->post('/', [
            'key' => config('upmidias.token'),
            "action" => "status",
            "order" => $this->sale->order
        ]);

        // valida se a requisição teve sucesso
        if (!$response->ok()) {
            // opcional: registrar erro
            return;
        }

        $order = $response->json();

        // garante que status existe
        if (!isset($order['status']) || empty($order['status'])) {
            $this->sale->update(['status' => 'Indefinido']);
            return;
        }

        // normaliza o status recebido
        $normalizedStatus = trim(strtolower($order['status']));

        // status que significam que ainda não completou
        $pendingStatuses = [
            'pending',
            'partial',
            'processing',
            'in progress',
        ];

        if (in_array($normalizedStatus, $pendingStatuses)) {

            $status = match ($normalizedStatus) {
                'pending' => 'Pendente',
                'partial' => 'Parcial',
                'processing' => 'Processando',
                'in progress' => 'Em andamento',
                default => 'Desconhecido',
            };

            // reagendar verificação
            self::dispatch($this->sale)->delay(now()->addMinutes(1));

            $this->sale->update(['status' => $status]);
            return;
        }

        // Cancelado
        if ($normalizedStatus === 'canceled') {
            $this->sale->update(['status' => 'Cancelado']);
            return;
        }

        // Completo
        if ($normalizedStatus === 'completed') {

            $userStore = $this->sale->service->user;

            $commission = ($this->sale->quantity * ($this->sale->service->rate / 1000))
                - ($this->sale->quantity * ($this->sale->service->coast / 1000));

            $userStore->increment('balance', $commission);
            $this->sale->user->decrement('balance', $this->sale->totalValue);

            $this->sale->update(['status' => 'Completo']);
            return;
        }

        // fallback para qualquer outro status improvável
        $this->sale->update(['status' => ucfirst($normalizedStatus)]);
    }

}
