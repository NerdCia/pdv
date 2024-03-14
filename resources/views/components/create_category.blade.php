@extends('components.products')

@section('title', 'Criar nova categoria')

@section('modal')

  <div class="modal fade" id="createCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-4 border-0">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="categoryModalLabel"><i
              class="bi bi-bookmarks fs-2 me-2"></i>Criar nova categoria</h1>
          <a type="button" class="btn-close" href="{{ route('components.products') }}"></a>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="mb-3">
              <label for="categoryInputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome da
                  categoria:</small></label>
              <input type="text" class="form-control shadow" name="name" id="categoryInputName"
                placeholder="Digite o nome da categoria" required>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-3">
              <button type="submit" class="btn btn-danger rounded-pill">Adicionar</button>
            </div>
          </form>
          <div class="modal-footer border-0">
            <table class="bg-white w-100 shadow align-middle rounded-4 mb-3 ">
              <thead>
                <tr class="border-bottom">
                  <th class="fw-bold py-3 px-4 text-body-emphasis" scope="col">Categorias</th>
                  <th class="py-3 ps-4" scope="col"></th>
                  <th class="py-3 ps-4" scope="col"></th>
                </tr>
              </thead>
              <tbody class="overflow-y-auto">
                @forelse ($categories as $key => $category)
                  @if ($category->name != 'raiz')
                    <tr class="{{ $key == count($categories) - 1 ? '' : 'border-bottom' }}">
                      <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @method('POST')
                        @csrf
                        <td class="py-2 ps-4"><input class="form-control form-control-sm" placeholder="Nome da categoria"
                            type="text" name="name" value="{{ $category->name }}"></td>
                        <td class="text-center py-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                              class="bi bi-arrow-clockwise"></i></button></td>
                      </form>
                      <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <td class="py-2 text-center"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                              class="bi bi-x-lg"></i></button></td>
                      </form>
                    </tr>
                  @endif
                @empty
                  <tr>
                    <td colspan="3" class="py-3 text-center fw-bold"></td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{ $categories->links() }}

        </div>
      </div>
    </div>
  </div>

@endsection
