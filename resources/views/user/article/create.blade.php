@extends('template')

@section('style')

    <style>

        .ck-restricted-editing_mode_standard{

            min-height: 500px;
        }

    </style>

@endsection

@section('script_include_header')

    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>

@endsection

@section('body')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Maqola</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Yangi maqola</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Yangi maqola formasi</h6>
                <hr>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary">Ma'lumotlarni to'ldiring</h5>
                        </div>
                        <hr>
                        <form class="row g-3" method="post" action="{{ route('user.article.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">{{ $error }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <label for="name" class="form-label">Sarlavha</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>

                            <div class="col-md-12">
                                <label for="web_addres" class="form-label">URL</label>
                                <input type="text" name="web_addres" class="form-control" id="web_addres">
                            </div>

                            <div class="col-md-12">
                                <label for="file" class="form-label">PDF</label>
                                <input type="file" name="file" class="form-control" id="file">
                            </div>

                            <div class="col-md-12">
                                <label for="article" class="form-label">Maqola matni</label>
                                <textarea class="form-control" id="article" name="article" rows="8"></textarea>
                            </div>

                            <div class="col-12">
                                <button id="but_submit" type="submit" class="btn btn-primary px-5" disabled>Saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>


@endsection

@section('scripte_include_end_body')

<script>

    CKEDITOR.ClassicEditor.create(document.getElementById("article"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
        items: [
            'exportPDF','exportWord', '|',
            'findAndReplace', 'selectAll', '|',
            'heading', '|',
            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'outdent', 'indent', '|',
            'undo', 'redo',
            '-',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
            'alignment', '|',
            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
            'specialCharacters', 'horizontalLine', 'pageBreak', '|',
            'textPartLanguage', '|',
            'sourceEditing'
        ],
        shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true
        }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
        ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Maqola',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
        options: [
            'default',
            'Arial, Helvetica, sans-serif',
            'Courier New, Courier, monospace',
            'Georgia, serif',
            'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'Tahoma, Geneva, sans-serif',
            'Times New Roman, Times, serif',
            'Trebuchet MS, Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif'
        ],
        supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
        options: [ 10, 12, 14, 'default', 18, 20, 22 ],
        supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
        allow: [
            {
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }
        ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
        showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file'
                }
            }
        }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
        feeds: [
            {
                marker: '@',
                feed: [
                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                    '@sugar', '@sweet', '@topping', '@wafer'
                ],
                minimumCharacters: 1
            }
        ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
        // These two are commercial, but you can try them out without registering to a trial.
        // 'ExportPdf',
        // 'ExportWord',
        'CKBox',
        'CKFinder',
        'EasyImage',
        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        // Storing images as Base64 is usually a very bad idea.
        // Replace it on production website with other solutions:
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        // 'Base64UploadAdapter',
        'RealTimeCollaborativeComments',
        'RealTimeCollaborativeTrackChanges',
        'RealTimeCollaborativeRevisionHistory',
        'PresenceList',
        'Comments',
        'TrackChanges',
        'TrackChangesData',
        'RevisionHistory',
        'Pagination',
        'WProofreader',
        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        'MathType',
        // The following features are part of the Productivity Pack and require additional license.
        'SlashCommand',
        'Template',
        'DocumentOutline',
        'FormatPainter',
        'TableOfContents'
        ]
    }).then( newEditor => {
        editor = newEditor;
    })
    .catch( error => {
        console.error( error );
    });

    $('#web_addres').on('keyup', function(){
        if($(this).val() != ''){
            $('#but_submit').removeAttr('disabled');
        }else{
            $('#but_submit').attr('disabled', '');
        }
    });

</script>

@endsection
