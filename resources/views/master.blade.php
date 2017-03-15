<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Programas de Estudio</title>
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/metisMenu.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/sb-admin-2.css")}}" rel="stylesheet">
    <link href="{{asset("css/morris.css")}}" rel="stylesheet">
    <link href="{{asset("css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">
    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>
    <script src="{{asset("js/metisMenu.min.js")}}"></script>
    <script src="{{asset("js/raphael.min.js")}}"></script>
    <script src="{{asset("js/morris.min.js")}}"></script>
    <script src="{{asset("js/morris-data.js")}}"></script>
    <script src="{{asset("js/sb-admin-2.js")}}"></script>
</head>

<body>

    <div id="wrapper">

       <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">Instituto Tecnológico de Culiacán</a>
            </div>        
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            @yield('lista')
                       </li>
                       <li>
                            <a href=""><i class="fa fa-bar-chart-o fa-fw"></i> Acciones
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('registrarMateria')}}">Registrar Materia</a>
                                </li>
                                <li>
                                    <a href="{{url('registrarPrograma')}}">Registrar Programa de Estudio</a>
                                </li>
                            </ul>
                       </li>
                    </ul>
                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
      
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    @yield('titulo')
                    @yield('contenido')                
                
                </div>    
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
</body>

</html>
