<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.75rem;">
                {{ __('Daftar Pesanan Masuk') }}
            </h2>
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <!-- Tombol Kelola Menu -->
                <a href="{{ route('foods.index') }}" style="background-color: #4f46e5; color: #ffffff; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; text-decoration: none; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                    Kelola Menu
                </a>
                
                <!-- Tombol Lihat Menu Customer -->
                <a href="{{ route('customer.index') }}" target="_blank" style="background-color: #1f2937; color: #ffffff; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; text-decoration: none; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                    Lihat Menu Customer
                </a>
            </div>
        </div>
    </x-slot>

    <div style="padding-top: 3rem; padding-bottom: 3rem;">
        <div style="max-width: 80rem; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem;">
            @if(session('success'))
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #d1fae5; border-left: 4px solid #10b981; color: #065f46; border-radius: 0.375rem; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); font-weight: 700;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background-color: #ffffff; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1); border-radius: 0.5rem; border: 1px solid #d1d5db;">
                <div style="padding: 1.5rem; overflow-x: auto;">
                    <table style="width: 100%; text-align: left; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f3f4f6; color: #111827; text-transform: uppercase; font-size: 0.75rem; font-weight: 800; border-bottom: 2px solid #d1d5db;">
                                <th style="padding: 1rem;"># ID</th>
                                <th style="padding: 1rem;">Pelanggan</th>
                                <th style="padding: 1rem;">No. Meja</th>
                                <th style="padding: 1rem;">Rincian Pesanan</th>
                                <th style="padding: 1rem;">Total Harga</th>
                                <th style="padding: 1rem;">Status</th>
                                <th style="padding: 1rem; text-align: center;">Aksi Status</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.875rem;">
                            @forelse($orders as $order)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 1rem; font-weight: 800; color: #111827;">#{{ $order->id }}</td>
                                    <td style="padding: 1rem; font-weight: 800; color: #111827;">{{ $order->customer_name }}</td>
                                    <td style="padding: 1rem;">
                                        <span style="background-color: #dbeafe; color: #1e40af; font-weight: 800; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.75rem;">
                                            Meja {{ $order->table_number }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem;">
                                        <ul style="list-style-type: disc; padding-left: 1.25rem; margin: 0; display: flex; flex-direction: column; gap: 0.25rem; color: #111827; font-weight: 600;">
                                            @foreach($order->orderDetails as $detail)
                                                <li>
                                                    <strong style="color: #111827; font-weight: 700;">{{ $detail->food->name ?? 'Menu' }}</strong> 
                                                    <span style="color: #1f2937; font-weight: 700;">x{{ $detail->quantity }}</span> 
                                                    <span style="font-size: 0.75rem; color: #4b5563; font-weight: 600;">(Rp {{ number_format($detail->subtotal) }})</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="padding: 1rem; font-weight: 800; color: #047857;">
                                        Rp {{ number_format($order->total_price) }}
                                    </td>
                                    <td style="padding: 1rem;">
                                        @if(strtolower($order->status) == 'pending')
                                            <span style="background-color: #fef3c7; color: #92400e; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.625rem; border-radius: 0.25rem;">PENDING</span>
                                        @elseif(strtolower($order->status) == 'completed' || strtolower($order->status) == 'selesai')
                                            <span style="background-color: #d1fae5; color: #065f46; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.625rem; border-radius: 0.25rem;">SELESAI</span>
                                        @else
                                            <span style="background-color: #fee2e2; color: #991b1b; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.625rem; border-radius: 0.25rem;">{{ strtoupper($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" style="font-size: 0.75rem; border: 1px solid #9ca3af; border-radius: 0.375rem; padding: 0.375rem 0.75rem; background-color: #ffffff; color: #111827; font-weight: 800; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); cursor: pointer; min-width: 130px;">
                                                <option value="pending" {{ strtolower($order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ strtolower($order->status) == 'completed' || strtolower($order->status) == 'selesai' ? 'selected' : '' }}>Selesai / Lunas</option>
                                                <option value="cancelled" {{ strtolower($order->status) == 'cancelled' || strtolower($order->status) == 'batal' ? 'selected' : '' }}>Batalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding: 1.5rem; text-align: center; color: #4b5563; font-weight: 700;">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>