<h1>{{ $comment->user->name }}さんのメッセージ</h1>
<p>講義動画: {{ $comment->video->class }} - {{ $comment->video->chapter }} - {{ $comment->video->section }} - {{ $comment->video->title }}</p>
<p>メッセージ送信日: {{ $comment->created_at->format('Y年m月d日 H時i分') }}</p>
@component('mail::panel')
    {{ $comment->message }}
@endcomponent
@component('mail::button', ['url' => route('show', ['class_key' => $comment->video->class_key, 'chapter_key' => $comment->video->chapter_key, 'section_key' => $comment->video->section_key, 'video_id' => $comment->video->video_id]), 'color' => 'success'])
    メッセージの確認
@endcomponent
