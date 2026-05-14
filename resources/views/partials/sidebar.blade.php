<div class="sidebar">

    <h3>Barangay</h3>

    @if(Auth::user()?->role == 'super_admin')

    <a href="/superadmin/dashboard">
        <i class="bi bi-grid"></i>
        <span> Dashboard</span>
    </a>

    <a href="/superadmin/barangays">
        <i class="bi bi-building"></i>
        <span> Barangays</span>
    </a>

    <a href="/superadmin/workers">
        <i class="bi bi-people"></i>
        <span> Barangay Workers</span>
    </a>

    @endif

    @if(Auth::user()?->role == 'barangay_worker')

    <a href="/barangay/dashboard">
        <i class="bi bi-grid"></i>
        <span> Dashboard</span>
    </a>

    <a href="/barangay/residents">
        <i class="bi bi-person"></i>
        <span> Residents</span>
    </a>

    <a href="/barangay/requests">
        <i class="bi bi-file-earmark-text"></i>
        <span> Requests</span>
    </a>

    <a href="/barangay/complaints">
        <i class="bi bi-exclamation-circle"></i>
        <span> Complaints</span>
    </a>

    @endif

    <a href="/logout">
        <i class="bi bi-box-arrow-right"></i>
        <span> Logout</span>
    </a>

</div>