<div class="text_activity">
    <label>
        Заголовок -
        @error('activity_title')
        <div class="alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="title" placeholder="Заголовок" style="margin-bottom: 20px" value="{{ old('activity_title') }}">
        @error('activity_text')
        <div class="alert-danger">{{ $message }}</div>
        @enderror
        <textarea name="content" id="basic-wysiwyg" value="{{ old('activity_text') }}"></textarea>
    </label>
</div>
