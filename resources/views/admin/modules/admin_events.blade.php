<div class="card card-body border-0 shadow table-wrapper table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">#</th>
                <th class="border-gray-200">Заголовок</th>						
                <th class="border-gray-200">Дата</th>
                <th class="border-gray-200"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <!-- Item -->
            <tr>
                <td>
                    <a href="#" class="fw-bold">
                        {{ $event->id }}
                    </a>
                </td>
                <td>
                    <span class="fw-normal">{{ $event->title }}</span>
                </td>
                <td><span class="fw-normal">{{ Carbon\Carbon::parse($event->date_public)->format('d.m.Y H:i:s') }}</span></td>
                <td>
                    <div class="btn-group">
                        <form action="{{ route('events.destroy', $event->id) }}" method="post">
                            @csrf
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu py-0">
                                <a class="dropdown-item" href="{{ route('events.edit', $event->id) }}"><span class="fas fa-edit me-2"></span>Редактировать</a>
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger rounded-bottom"><span class="fas fa-trash-alt me-2"></span>Удалить</button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach                    
        </tbody>
    </table>
    <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        {{ $events->onEachSide(0)->links() }}
    </div>
</div>