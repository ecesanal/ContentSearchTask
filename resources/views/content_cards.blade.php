@forelse($contents as $content)
    <div class="content-card">
        <div>
            <h3>{{ $content->title }}</h3>
            <p>{{ Str::limit($content->content, 100) }}</p>
        </div>
        <div class="content-actions">
            <a href="{{ route('admin.editContent', $content->id) }}"><i class="fas fa-edit"></i> Düzenle</a>
            <form method="POST" action="{{ route('admin.deleteContent', $content->id) }}" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                @csrf
                @method('DELETE')
                <button type="submit"><i class="fas fa-trash-alt"></i> Sil</button>
            </form>
        </div>
    </div>
@empty
    <p>Hiç içerik bulunamadı.</p>
@endforelse
