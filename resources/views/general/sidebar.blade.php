<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="/dashboard" class="brand-link">
		<img src="{{ url('/assets/img/logo.jpg') }}" alt="page logo" class="brand-image elevation-3">
		<span class="brand-text font-weight-bold">Grupo Trazo</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="info">
				@if ( auth()->user()->type == 'cliente' )
				<a href="#" class="d-block">{{ auth()->user()->cliente->nombre }}</a>
				@elseif ( auth()->user()->type == 'contratista' )
				<a href="#" class="d-block">{{ auth()->user()->contratista->nombre }}</a>
				@elseif ( auth()->user()->type == 'coordinador' )
				<a href="#" class="d-block">{{ auth()->user()->cat->nombre }}</a>
				@else
				<a href="#" class="d-block">{{ auth()->user()->name . ' ' . auth()->user()->surname }}</a>
				@endif
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				<li class="nav-header">Menu</li>
				@if ( auth()->user()->type == 'user' )
				<li class="nav-item">
					<a href="/clientes" class="nav-link" id="clientes"> <!-- active -->
						<i class="nav-icon fas fa-user"></i>
						<p>
							Clientes
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/contratistas" class="nav-link" id="contratistas">
						<i class="nav-icon fas fa-user"></i>
						<p>
							Contratistas
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/cat" class="nav-link" id="cat">
						<i class="nav-icon fas fa-user"></i>
						<p>
							CAT
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/tickets" class="nav-link" id="tickets">
						<i class="nav-icon fas fa-ticket-alt"></i>
						<p>
							Ticket
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>
							Estadistícas
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/estadistica-proyectos" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Estadistícas por proyecto</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/estadistica-contratista" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Estadistícas por contratista</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/estadistica-valoracion" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Estadistícas valoracion</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/estadistica-solucion" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Estadistícas solución</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/estadistica-satisfaccion" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Estadistícas satisfacción</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Herramientas
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/condominios" class="nav-link">
								<i class="fas fa-hotel nav-icon"></i>
								<p>Condominios</p>
							</a>
						</li>
					</ul>
				</li>
				@else
				<li class="nav-item">
					<a href="/tickets" class="nav-link" id="tickets">
						<i class="nav-icon fas fa-ticket-alt"></i>
						<p>
							Ticket
						</p>
					</a>
				</li>
				@endif
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>