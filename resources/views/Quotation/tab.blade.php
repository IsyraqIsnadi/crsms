<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('tab1') ? 'active': null }}" href="{{ url('tab1') }}" role="tab">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('tab2') ? 'active': null }}" href="{{ url('tab2') }}" role="tab">Approved</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('tab3') ? 'active': null }}" href="{{ url('tab3') }}" role="tab">Rejected</a>
        </li>
    </ul><!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane {{ request()->is('tab1') ? 'active': null }}" id="{{ url('tab1') }}" role="tabpanel">
            <p>First Panel</p>
        </div>
        <div class="tab-pane {{ request()->is('tab2') ? 'active': null }}" id="{{ url('tab2') }}" role="tabpanel">
            <p>Second Panel</p>
        </div>
        <div class="tab-pane {{ request()->is('tab3') ? 'active': null }}" id="{{ url('tab3') }}" role="tabpanel">
            <p>Third Panel</p>
        </div>
    </div>
</body>
    
</body>
</html>

