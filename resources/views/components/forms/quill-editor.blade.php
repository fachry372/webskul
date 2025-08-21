
@props(['id', 'content'])
<div id="editor-{{ $id }}" style="min-height: 200px;">{!! $content ?? '' !!}</div>
<textarea name="{{ $id }}" id="{{ $id }}" style="display: none;">{!! htmlspecialchars($content ?? '') !!}</textarea>

