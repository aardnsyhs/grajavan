<x-mail::message>
    # Pesanan berhasil dibuat!

    Terimakasih sudah memesan. Nomor pesanan kamu adalah: {{ $order->id }}

    <x-mail::button :url="$url">
        Lihat pesanan
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
