<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menu</li>
    <li class="active"><a href="{{ url('/') }}">
      <i class="fa fa-dashboard fa-lg"></i>
       <span>แดชบอร์ด</span></a>
    </li>
  <li class="active"><a href="{{ url('/user') }}">
    <i class="fa fa-users fa-lg"></i>
     <span>ผู้ใช้งาน</span></a>
  </li>
  <!--treeview  -->
  <li class="treeview active">
    <a href="#">
      <i class="fa fa-ticket fa-lg"></i>
      <span>ข้อมูลการขายบัตร</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('/sale/employee') }}"><i class="fa fa-circle-o"></i>พนักงาน</a></li>
      <li><a href="{{ url('/sale/guide') }}"><i class="fa fa-circle-o"></i>ไกด์</a></li>
      <li><a href="{{ url('/sale/office') }}"><i class="fa fa-circle-o"></i>หน้า Office</a></li>
    </ul>
  </li>  
  <!--treeview  -->
  <li class="active"><a href="{{ url('/ticket') }}">
    <i class="fa fa-edit fa-lg"></i>
     <span>จัดการบัตร</span></a>
  </li>
  <li class="active"><a href="{{ url('/guesthouse') }}">
    <i class="fa fa-hotel fa-lg"></i>
     <span>จัดการเกสเฮาส์</span></a>
  </li>
  <li class="active"><a href="{{ url('/chart/') }}">
    <i class="fa fa-flag fa-lg" style="color: #eaffff"></i>
     <span>รายงานการขาย</span></a>
  </li>

  <li class="treeview active">
    <a href="#">
      <i class="fa fa-usd fa-lg"></i> <span>ค่าคอมมิชชั่น</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('/commissionOfEmp') }}">
        <i class="fa fa-circle-o"></i>
         <span>พนักงาน</span></a>
      </li>
      <li><a href="{{ url('/commissionOfGuide') }}">
        <i class="fa fa-circle-o"></i>
         <span>ไกด์</span></a>
      </li>
    </ul>
  </li>




 
  </ul>