<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header">
        <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="categoryModalLabel"><i
            class="bi bi-bookmarks fs-2 me-2"></i>Criar nova categoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="categoryInputName" class="form-label fw-bold fs-5 text-black">Nome da categoria:</label>
            <input type="text" class="form-control rounded-pill shadow" name="name" id="categoryInputName"
              placeholder="Digite o nome da categoria">
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mb-3">
            <button type="button" class="btn btn-danger rounded-pill">Adicionar</button>
          </div>
        </form>
        <div class="modal-footer border-0">
          <table class="bg-white w-100 shadow align-middle rounded-5 mb-3 ">
            <thead>
              <tr class="border-bottom">
                <th scope="col"></th>
                <th class="fw-bold py-3 text-body-emphasis" scope="col">Categorias</th>
                <th class="fw-bold py-3" scope="col"></th>
              </tr>
            </thead>
            <tbody class="overflow-y-auto">
              @foreach ($list as $category)
                <tr class="border-bottom">
                  <td class="text-center p-2 fs-5"><input class="form-check-input" type="checkbox" value="{{ $category->id }}"></td>
                  <td class="py-2">{{ $category->name }}</td>
                  <td class="p-2 text-center"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i class="bi bi-x-lg"></i></button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>