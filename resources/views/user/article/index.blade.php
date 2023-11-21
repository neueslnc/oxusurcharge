@extends('template')

@section('script_include_header')

    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>

@endsection

@section('body')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Maqolalar</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <h6 class="mb-0 text-uppercase">Barcha maqolalar</h6>
        </div>

        <div class="d-flex align-items-center">
            <div class="ms-auto">
                <a href="{{ route('user.article.create') }}" class="btn btn-primary px-3"><i class="bx bx-plus"></i>Yangi maqola</a>
            </div>
        </div>

        <hr>

        <div class="card radius-10">
            <div class="card-body">
                {{-- <div class="alert alert-light"  role="alert">
                  Qator--Bu hali ko'rilmagan maqolalar rangi!
                  </div>
                  <div class="alert alert-success" role="alert">
                    Qator--Qabul qilingan maqolalar rangi!
                  </div>
                  <div class="alert alert-warning" role="alert">
                    Qator--Rad etilgan maqolalar  rangi!
                  </div> --}}


                  <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="">
                <td>
                    Qator--Bu hali ko'rilmagan maqolalar rangi!
                </td>
               </tr>
               <tr class="table-success">
                <td>
                    Qator--Qabul qilingan maqolalar rangi!
                </td>
               </tr>
               <tr class="table-danger">
                <td>
                    Qator--Rad etilgan maqolalar  rangi!
                </td>
               </tr>
                    </tbody>
                </table>
         
            </div>
            <div class="card-body">

                <div class="">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="fixed_header2 align-middle">#</th>
                                <th class="fixed_header2 align-middle">Sarlavha</th>
                                <th class="fixed_header2 align-middle">Maqola berilgan sana</th>
                                <th class="fixed_header2 align-middle">Link</th>
                                <th class="fixed_header2 align-middle">File</th>
                                <th class="fixed_header2 align-middle">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($articles as $i => $article)
                            @php
                            $class="";
                          if (  $article->status==0 ) {
                             $class="";
                          }
                          elseif ( $article->status==1) {
                             $class="table-success";
                          }
                   
                          elseif ( $article->status==2) {
                             $class="table-danger";
                          }
                           
                          @endphp
                                <tr class="{{ $class }}">
                                               
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        {{ $article->name }}
                                    </td>
                                    <td>
                                        {{ $article->date_create() }}
                                    </td>
                                    <td>
                                        @foreach (explode(',', $article->web_addres) as $item)
                                            
                                            <a href="{{ $item }}" target="_blank">{{ $item }}</a>,
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('storage/'.$article->file) }}" target="_blank">Посмотреть</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal_{{ $article->id }}">Посмотреть</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-body">

                        {{ $articles->links() }}
                    </div>

                </div>
            </div>
        </div>
   </div>
</div>

@foreach ($articles as $i => $article)

    <div class="modal fade" id="exampleExtraLargeModal_{{ $article->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Maqola</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- <textarea id="article_{{ $article->id }}" cols="30" rows="10"> --}}
                        {!! $article->article !!}
                    {{-- </textarea> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script>

        CKEDITOR.ClassicEditor.create(document.getElementById("article_{{ $article->id }}"), {
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

    </script>

@endforeach

@endsection
