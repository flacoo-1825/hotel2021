<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="img/logo3.png" type="image/png" sizes="40x40">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Hotel Casa Aragon</title>
    <!-- Icons -->
    <link href="css/all.css" rel="stylesheet">
    <link href="css/simple-line-icons.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet"> 
    <link href="css/styleHotel.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Escritorio</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Configuraciones</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Ingresos
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> Ventas
                        <span class="badge badge-danger">2</span>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">admin </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body" id="app">
        <div class="sidebar" >
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item" @click="indice=0">
                        <a class="nav-link active" href="#"><i class="fas fa-street-view"></i> Recepción</a>
                    </li>
                    <li class="nav-title">
                        Administrativo
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-bed"></i> Habitaciones</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="indice=1">
                                <a class="nav-link" href="#"><i class="fas fa-cogs"></i> Tipo de Habitacion</a>
                            </li>
                            <li class="nav-item" @click="indice=2">
                                <a class="nav-link" href="#"><i class="fas fa-bed"></i> Habitaciones</a>
                            </li>
                        </ul>
                    </li>
                
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-file-invoice"></i> Facturas</a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item" @click="indice=3">
                                    <a class="nav-link" href="#"><i class="fab fa-cc-visa"></i> ventas</a>
                                </li>
                                <li class="nav-item" @click="indice=4">
                                    <a class="nav-link" href="#"><i class="fas fa-cash-register"></i> Ventas Extras</a>
                                </li>
                                <li class="nav-item" @click="indice=5">
                                    <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Compras</a>
                                </li>
                                <li class="nav-item" @click="indice=26">
                                    <a class="nav-link" href="#"><i class="fas fa-toolbox"></i> Caja</a>
                                </li>
                                <li class="nav-item" @click="indice=27">
                                    <a class="nav-link" href="#"><i class="fas fa-toolbox"></i><i class="fas fa-user-friends"></i> Admin caja</a>
                                </li>
                            </ul>
                        </li>
                 
                        <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-ellipsis-v"></i> Inventario</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="indice=20">
                                <a class="nav-link" href="#"><i class="fas fa-spell-check"></i> Categorias</a>
                            </li>
                            <li class="nav-item" @click="indice=21">
                                <a class="nav-link" href="#"><i class="fas fa-list-ol"></i> Productos</a>
                            </li>
                            <li class="nav-item" @click="indice=24">
                                <a class="nav-link" href="#"><i class="fas fa-plus-circle"></i></i> Servicios</a>
                            </li>
                            <li class="nav-item" @click="indice=22">
                                <a class="nav-link" href="#"><i class="fas fa-people-arrows"></i> Proveedores</a>
                            </li>
                            <li class="nav-item" @click="indice=6">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Inventario total</a>
                            </li>
                            <li class="nav-item" @click="indice=7">
                                <a class="nav-link" href="#"><i class="fas fa-shopping-basket"></i> Canasta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-users"></i> Empleados</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="indice=8">
                                <a class="nav-link" href="#"><i class="fas fa-address-card"></i> Tipo de Vinculación</a>
                            </li>
                            <li class="nav-item" @click="indice=9">
                                <a class="nav-link" href="#"><i class="fas fa-user-friends"></i> Empleados</a>
                            </li>
                            <li class="nav-item" @click="indice=10">
                                <a class="nav-link" href="#"><i class="fas fa-key"></i> Cargo</a>
                            </li>
                            <li class="nav-item" @click="indice=11">
                                <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i> Horario</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="indice=12">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li class="nav-item" @click="indice=13">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i>Reportes<span class="badge badge-danger">PDF</span><span class="badge badge-success">EXCEL</span></a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="indice=14">
                                <a class="nav-link" href="#"><i class="fas fa-chart-bar"></i> Reporte Ingresos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="indice=15"><i class="icon-chart"></i> Reporte Ventas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="indice=25"><i class="fas fa-file-download"></i> Listados Excel y Pdf</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" @click="indice=16">
                                <a class="nav-link" href="#"><i class="fas fa-money-check"></i> Actas de Ingreso</a>
                            </li>
                    <li class="nav-item" @click="indice=17">
                        <a class="nav-link" href="#"><i class="fas fa-user-plus"></i> Clientes </a>
                    </li>
                    <li class="nav-item" @click="indice=23">
                        <a class="nav-link" href="#"><i class="fas fa-street-view"></i> Acompañantes </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-recycle"></i> Residuos</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="indice=18">
                                <a class="nav-link" href="#"><i class="fab fa-battle-net"></i> Residuos Ordinarios</a>
                            </li>
                            <li class="nav-item" @click="indice=19">
                                <a class="nav-link" href="#"><i class="fas fa-trash-restore-alt"></i> Residuos Peligrosos</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Contenido Principal -->
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-itemm"></li>
                <li class="breadcrumb-itemm"><a href="#"></a></li>
                <li class="breadcrumb-itemm active"></li>
            </ol>
            <reception v-if="indice==0"></reception>
            <type-room v-if="indice==1"></type-room>
            <room v-if="indice==2"></room>
            <ticket v-if="indice==3"></ticket>
            <checkbook v-if="indice==4"></checkbook>
            <buy v-if="indice==5"></buy>
            <links v-if="indice==8"></links>
            <worker v-if="indice==9"></worker>
            <user v-if="indice==12"></user>
            <role v-if="indice==13"></role>
            <certificate v-if="indice==16"></certificate>
            <client v-if="indice==17"></client>
            <category v-if="indice==20"></category>
            <product v-if="indice==21"></product>
            <servicie v-if="indice==24"></servicie>
            <provider v-if="indice==22"></provider>
            <companion v-if="indice==23"></companion>
            <export v-if="indice==25"></export>
            <box v-if="indice==26"></box>
            <adminbox v-if="indice==27"></adminbox>

        </main>
    </div>
    <footer class="app-footer">
        <span><a href="http://www.incanatoit.com/">Hotel Casa Aragon</a> &copy; 2020</span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="js/Chart.min.js"></script>
    <script src="js/sweetalert2.all.js"></script>

    <!-- GenesisUI main scripts -->
    <script src="js/template.js"></script>
</body>

</html>