<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
@if (\Config::get('app.locale') == 'ar')
    <!-- Bootstrap 4 rtl -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
@endif
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('js/dselect.js') }}"></script>
<script src="{{ asset('js/simplebar.min.js') }}"></script>
<script src='{{ asset('js/daterangepicker.js') }}'></script>
<script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.js') }}"></script>
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/uppy.min.js') }}"></script>
<script src="{{ asset('js/quill.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/tinycolor-min.js') }}"></script>
{{-- <script src="{{asset('js/Chart.min.js')}}"></script> --}}
{{-- <script src="{{asset('js/apexcharts.min.js')}}"></script> --}}
{{-- <script src="{{asset('js/apexcharts.custom.js')}}"></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/plugins/adminlte.min.js') }}"></script>




<script>
    $('.select2').select2({
        theme: 'bootstrap4',
    });
    $('.select2-multi').select2({
        multiple: true,
        theme: 'bootstrap4',
    });
    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });
    $('.time-input').timepicker({
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
    });
    /** date range picker */
    if ($('.datetimes').length) {
        $('.datetimes').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000", {
        placeholder: "__/__/____"
    });
    $('.input-zip').mask('00000-000', {
        placeholder: "____-___"
    });
    $('.input-money').mask("#.##0,00", {
        reverse: true
    });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/,
                optional: true
            }
        },
        placeholder: "___.___.___.___"
    });
    // editor
    var editor = document.getElementById('editor');
    if (editor) {
        var toolbarOptions = [
            [{
                'font': []
            }],
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{
                    'header': 1
                },
                {
                    'header': 2
                }
            ],
            [{
                    'list': 'ordered'
                },
                {
                    'list': 'bullet'
                }
            ],
            [{
                    'script': 'sub'
                },
                {
                    'script': 'super'
                }
            ],
            [{
                    'indent': '-1'
                },
                {
                    'indent': '+1'
                }
            ], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction
            [{
                    'color': []
                },
                {
                    'background': []
                }
            ], // dropdown with defaults from theme
            [{
                'align': []
            }],
            ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script>
    var uptarg = document.getElementById('drag-drop-area');
    if (uptarg) {
        var uppy = Uppy.Core().use(Uppy.Dashboard, {
            inline: true,
            target: uptarg,
            proudlyDisplayPoweredByUppy: false,
            theme: 'dark',
            width: 770,
            height: 210,
            plugins: ['Webcam']
        }).use(Uppy.Tus, {
            endpoint: 'https://master.tus.io/files/'
        });
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
    }
</script>
<script src="{{ asset('js/apps.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
@stack('scripts')
<script>
    function deleteItem($url) {
        if (confirm('<?php echo e(__('Are you sure you want to delete this item?')); ?>')) {
            $('#delete-form').attr('action', $url);
            $('#delete-form').submit();
        }
    }

    $('.select-all').click(function() {
        let $select2 = $(this).parent().siblings('.select2');
        $select2.find('option').prop('selected', 'selected');
        $select2.trigger('change');
    });
    $('.deselect-all').click(function() {
        let $select2 = $(this).parent().siblings('.select2');
        $select2.find('option').prop('selected', '');
        $select2.trigger('change');
    });
</script>
@yield('scripts')
