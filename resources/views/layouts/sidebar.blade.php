 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link " href="{{ route('dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         {{--  MENU ADMIN --}}

         {{-- AMBIL SESSION YG LOGIN (PD FIELD role yg ada di tabel users) --}}
         @if (Auth::user()->role == 'Adm')
             <li class="nav-item">
                 <a class="nav-link " href="{{ route('user') }}">
                     <i class="bi bi-person"></i>
                     <span>User</span>
                 </a>
             </li><!-- End User Nav -->

             <li class="nav-item">
                 <a class="nav-link " href="{{ route('kota') }}">
                     <i class="bi bi-person"></i>
                     <span>Kota</span>
                 </a>
             </li><!-- End Kota Nav -->

             <li class="nav-item">
                 <a class="nav-link " href="{{ route('hotel') }}">
                     <i class="bi bi-person"></i>
                     <span>Hotel</span>
                 </a>
             </li><!-- End Hotel Nav -->

             <li class="nav-item">
                 <a class="nav-link " href="{{ route('pemesanan') }}">
                     <i class="bi bi-person"></i>
                     <span>Pemesanan</span>
                 </a>
             </li><!-- End Pemesanan Nav -->

             <li class="nav-item">
                <a class="nav-link " href="{{ route('banner') }}">
                    <i class="bi bi-person"></i>
                    <span>Banner</span>
                </a>
            </li><!-- End Kota Nav -->
             {{-- AKHIR MENU ADMIN --}}

             {{-- MENU KASIR --}}
         @elseif(Auth::user()->role == 'Ksr')
             <li class="nav-item">
                 <a class="nav-link " href="index.html">
                     <i class="bi bi-person"></i>
                     <span>Pemesanan</span>
                 </a>
             </li><!-- End Pemesanan Nav -->
             {{-- AKHIR MENU KASIR --}}
         @endif


     </ul>

 </aside><!-- End Sidebar-->
