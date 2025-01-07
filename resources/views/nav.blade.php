<div class="bg-dark text-white mb-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col p-3">
                <h2 class="text-primary">Task Manager</h2>
            </div>
            <div class="col p-3 text-end">
                <span class="me-3"><i class="bi bi-person-circle me-2"></i>{{ session()->get('username') }}</span>
                <span><a href="{{ route('logout') }}" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right me-2"></i>Sair</a></span>
            </div>
        </div>
    </div>
</div>