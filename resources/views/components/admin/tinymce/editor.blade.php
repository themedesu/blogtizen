@php
    $heightOfEditor = !empty($height) ? $height : 500;
@endphp

<script>
    let heightOfEditor = {{$heightOfEditor}};
    tinymce.init({
        selector: '#editor-tiny-mce',
        height: heightOfEditor,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
        },
        image_class_list: [
            {title: 'img-normal', value: 'img-normal'},
            {title: 'img-responsive', value: 'img-responsive'},
        ],
        menubar: false,
        plugins: ['image', 'lists', 'code'],
        toolbar: 'undo redo | removeformat | fontfamily | fontsize | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code | image ',
        fontsize_formats: '8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 24pt 36pt 48pt',
        font_family_formats: 'Roboto=roboto; Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats; AkrutiKndPadmini=Akpdmi-n',
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        image_title: true,
        automatic_uploads: true,
        images_upload_url: `{{route("admin.tinymce.upload")}}`,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };
            input.click();
        },
        content_style:
            "@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');",
    });
</script>