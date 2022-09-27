<div class="card card-body border-0 shadow table-wrapper table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">#</th>
                <th class="border-gray-200">Заголовок</th>
                <th class="border-gray-200">Категория</th>						
                <th class="border-gray-200">Дата</th>
                <th class="border-gray-200"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $n)
            <!-- Item -->
            <tr>
                <td>
                    <a href="#" class="fw-bold">
                        {{ $n->id }}
                    </a>
                </td>
                <td>
                    <span class="fw-normal">{{ $n->title }}</span>
                </td>
                <td>
                    <span class="fw-normal">{{ $n->cat_title }}</span>
                </td>
                <td><span class="fw-normal">{{ Carbon\Carbon::parse($n->date)->format('d.m.Y') }}</span></td>
                <td>
                    <div class="btn-group">
                        <form action="{{ route('news.destroy', $n->id) }}" method="post">
                            @csrf
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu py-0">
                                <a class="dropdown-item" href="{{ route('news.edit', $n->id) }}"><span class="fas fa-edit me-2"></span>Редактировать</a>
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
        {{ $news->onEachSide(0)->links() }}
    </div>
</div>