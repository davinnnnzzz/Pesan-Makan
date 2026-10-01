<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.75rem;">Master Data Makanan</h2>
    </x-slot>
    <div style="padding-top: 3rem; padding-bottom: 3rem; max-width: 80rem; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem;">
        
        <!-- Tombol Tambah Makanan -->
        <a href="{{ route('foods.create') }}" style="background-color: #2563eb; color: #ffffff; padding: 0.625rem 1.25rem; border-radius: 0.375rem; display: inline-block; font-weight: 700; font-size: 0.875rem; text-transform: uppercase; text-decoration: none; margin-bottom: 1rem; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
            + Tambah Makanan
        </a>

        @if(session('success'))
            <div style="background-color: #d1fae5; border: 1px solid #34d399; color: #065f46; padding: 0.75rem; border-radius: 0.375rem; margin-bottom: 1rem; font-weight: 700;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f3f4f6; border-bottom: 2px solid #d1d5db; color: #111827; font-size: 0.875rem; font-weight: 800; text-transform: uppercase;">
                        <th style="padding: 1rem;">Gambar</th>
                        <th style="padding: 1rem;">Nama</th>
                        <th style="padding: 1rem;">Kategori</th>
                        <th style="padding: 1rem;">Harga</th>
                        <th style="padding: 1rem; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 1rem; text-align: center;">
                            @if($food->image)
                                <img src="{{ asset('storage/' . $food->image) }}" style="width: 4rem; height: 4rem; object-fit: cover; margin-left: auto; margin-right: auto; border-radius: 0.25rem;">
                            @else
                                <span style="color: #6b7280; font-size: 0.75rem; font-weight: 700;">No Image</span>
                            @endif
                        </td>
                        <td style="padding: 1rem; font-weight: 700; color: #111827; font-size: 0.95rem;">{{ $food->name }}</td>
                        <td style="padding: 1rem; font-weight: 600; color: #374151; font-size: 0.95rem;">{{ $food->category }}</td>
                        <td style="padding: 1rem; font-weight: 800; color: #047857; font-size: 0.95rem;">Rp {{ number_format($food->price) }}</td>
                        <td style="padding: 1rem; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 0.75rem; align-items: center;">
                                <a href="{{ route('foods.edit', $food->id) }}" style="color: #2563eb; font-weight: 700; text-decoration: none; font-size: 0.875rem;">Edit</a>
                                <form action="{{ route('foods.destroy', $food->id) }}" method="POST" style="display: inline; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" style="color: #dc2626; font-weight: 700; background: none; border: none; cursor: pointer; font-size: 0.875rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $foods->links() }}
        </div>
    </div>
</x-app-layout>