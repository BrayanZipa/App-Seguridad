<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>@yield('titulo', 'Ace')</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="../assets/ace/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/ace/css/font-awesome.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="../assets/ace/css/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="../assets/ace/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="../assets/ace/js/ace-extra.js"></script>

    @yield('css')

</head>

<body class="no-skin">

    <!-- #section:basics/navbar.layout -->
    @include('themes.ace.header')
    <!-- /section:basics/navbar.layout -->

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>


        <!-- #section:basics/sidebar -->
        @include('themes.ace.sidebar')

        <!-- /section:basics/sidebar -->
        <div class="main-content">
            @yield('contenido')
        </div><!-- /.main-content -->


        @include('themes.ace.footer')

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>
	<!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="../assets/ace/js/jquery.js"></script>
    <!-- <![endif]-->

    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write(
            "<script src='../assets/ace/js/jquery.mobile.custom.js'>" + "<" + "/script>");
    </script>
    <script src="../assets/ace/js/bootstrap.js"></script>

    <!-- page specific plugin scripts -->

    <!-- ace scripts -->
    <script src="../assets/ace/ace/js/ace/elements.scroller.js"></script>
    <script src="../assets/ace/js/ace/elements.colorpicker.js"></script>
    <script src="../assets/ace/js/ace/elements.fileinput.js"></script>
    <script src="../assets/ace/js/ace/elements.typeahead.js"></script>
    <script src="../assets/ace/js/ace/elements.wysiwyg.js"></script>
    <script src="../assets/ace/js/ace/elements.spinner.js"></script>
    <script src="../assets/ace/js/ace/elements.treeview.js"></script>
    <script src="../assets/ace/js/ace/elements.wizard.js"></script>
    <script src="../assets/ace/js/ace/elements.aside.js"></script>
    <script src="../assets/ace/js/ace/ace.js"></script>
    <script src="../assets/ace/js/ace/ace.ajax-content.js"></script>
    <script src="../assets/ace/js/ace/ace.touch-drag.js"></script>
    <script src="../assets/ace/js/ace/ace.sidebar.js"></script>
    <script src="../assets/ace/js/ace/ace.sidebar-scroll-1.js"></script>
    <script src="../assets/ace/js/ace/ace.submenu-hover.js"></script>
    <script src="../assets/ace/js/ace/ace.widget-box.js"></script>
    <script src="../assets/ace/js/ace/ace.settings.js"></script>
    <script src="../assets/ace/js/ace/ace.settings-rtl.js"></script>
    <script src="../assets/ace/js/ace/ace.settings-skin.js"></script>
    <script src="../assets/ace/js/ace/ace.widget-on-reload.js"></script>
    <script src="../assets/ace/js/ace/ace.searchbox-autocomplete.js"></script>

    <!-- inline scripts related to this page -->

    <!-- the following scripts are used in demo only for onpage help and you don't need them -->
    <link rel="stylesheet" href="../assets/ace/css/ace.onpage-help.css" />
    <link rel="stylesheet" href="../docs/assets/ace/js/themes/sunburst.css" />

    <script type="text/javascript">
        ace.vars['base'] = '..';
    </script>
    <script src="../assets/ace/js/ace/elements.onpage-help.js"></script>
    <script src="../assets/ace/js/ace/ace.onpage-help.js"></script>
    <script src="../docs/assets/ace/js/rainbow.js"></script>
    <script src="../docs/assets/ace/js/language/generic.js"></script>
    <script src="../docs/assets/ace/js/language/html.js"></script>
    <script src="../docs/assets/ace/js/language/css.js"></script>
    <script src="../docs/assets/ace/js/language/javascript.js"></script>
    @yield('scripts')
</body>

</html>
