tinymce.init({
    selector: 'textarea#basic-wysiwyg',
    height: 300,
    width: 700,
    menubar: 'insert',
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount',
        'preelementfix',
        'link'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help' +
        'link',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});


