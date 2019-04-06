<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menu</li>
    <li class="active"><a href="{{ url('/dashboard') }}">
      <i class="fa fa-dashboard fa-lg"></i>
       <span>แดชบอร์ด</span></a>
    </li>
    <li class="active"><a href="{{ url('user') }}">
      <i class="fa fa-users fa-lg"></i>
       <span>พนักงาน</span></a>
    </li>
  
    <li class="treeview">
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
    <li class="active"><a href="{{ url('/chart/') }}">
      <i class="fa fa-flag fa-lg" style="color: #eaffff"></i>
      <span>รายงานการขาย</span></a>
    </li>
    <li class="active"><a href="{{ url('/commission') }}">
      <i class="fa fa-hand-holding-usd fa-lg"></i>
      <span>ค่าคอมมิชชั่น</span></a>
    </li>
    <li class="active"><a href="{{ url('/income') }}">
      <i class="fa fa-usd fa-lg"></i>
      <span>รายได้เข้าสนาม</span></a>
    </li>
  </ul>