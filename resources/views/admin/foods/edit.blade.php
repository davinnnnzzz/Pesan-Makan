<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.75rem;">Edit Makanan</h2>
    </x-slot>
    <div style="padding-top: 3rem; padding-bottom: 3rem; max-width: 48rem; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem;">
        <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data" style="background-color: #ffffff; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1); border: 1px solid #d1d5db;">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 700; margin-bottom: 0.25rem; color: #111827; font-size: 0.875rem;">Nama Makanan</label>
                <input type="text" name="name" value="{{ $food->name }}" style="width: 100%; border: 1px solid #9ca3af; border-radius: 0.375rem; padding: 0.5rem 0.75rem; color: #111827; font-weight: 600; font-size: 0.875rem;" required>
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 700; margin-bottom: 0.25rem; color: #111827; font-size: 0.875rem;">Kategori</label>
                <select name="category" style="width: 100%; border: 1px solid #9ca3af; border-radius: 0.375rem; padding: 0.5rem 0.75rem; color: #111827; font-weight: 600; font-size: 0.875rem; background-color: #ffffff;" required>
                    <option value="Makanan" {{ $food->category == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="Minuman" {{ $food->category == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="Cemilan" {{ $food->category == 'Cemilan' ? 'selected' : '' }}>Cemilan</option>
                </select>
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 700; margin-bottom: 0.25rem; color: #111827; font-size: 0.875rem;">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $food->price }}" style="width: 100%; border: 1px solid #9ca3af; border-radius: 0.375rem; padding: 0.5rem 0.75rem; color: #111827; font-weight: 600; font-size: 0.875rem;" required>
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 700; margin-bottom: 0.25rem; color: #111827; font-size: 0.875rem;">Deskripsi</label>
                <textarea name="description" style="width: 100%; border: 1px solid #9ca3af; border-radius: 0.375rem; padding: 0.5rem 0.75rem; color: #111827; font-weight: 600; font-size: 0.875rem;" rows="3" required>{{ $food->description }}</textarea>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-weight: 700; margin-bottom: 0.25rem; color: #111827; font-size: 0.875rem;">Gambar Baru (Opsional)</label>
                <input type="file" name="image" style="width: 100%; border: 1px solid #9ca3af; border-radius: 0.375rem; padding: 0.5rem; color: #111827; font-weight: 600; font-size: 0.875rem; background-color: #f3f4f6;">
            </div>

            <button type="submit" style="background-color: #2563eb; color: #ffffff; padding: 0.625rem 1.25rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.875rem; text-transform: uppercase; border: none; cursor: pointer; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">Update Data</button>
        </form>
    </div>
</x-app-layout>