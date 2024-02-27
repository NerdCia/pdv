<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header">
        <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="productModalLabel"><i
            class="bi bi-bookmarks fs-2 me-2"></i>Criar novo produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="row g-3 mb-3">
            <div class="col-sm-7">
              <label for="productInputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome do
                  produto:</small></label>
              <input type="text" class="form-control shadow" name="name" id="productInputName"
                placeholder="Digite o nome do produto">
            </div>
            <div class="col-sm">
              <label for="productInputPrice" class="form-label"><small
                  class="fw-bold text-body-emphasis">Preço:</small></label>
              <input type="number" class="form-control" placeholder="Preço" aria-label="Preço" id="productInputPrice">
            </div>
            <div class="col-sm">
              <label for="productInputQuantity" class="form-label"><small
                  class="fw-bold text-body-emphasis">Quantidade:</small></label>
              <input type="number" class="form-control" placeholder="Quantidade" aria-label="Quantidade"
                id="productInputQuantity">
            </div>
          </div>
          <div class="mb-3">

          </div>
          <div class="mb-3">
            <label for="productInputDescription" class="form-label"><small class="fw-bold text-body-emphasis">Descrição
                do
                produto:</small></label>
            <textarea type="text" class="form-control shadow" name="name" id="productInputDescription"
              placeholder="Digite a descrição do produto"></textarea>
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mb-3">
            <button type="button" class="btn btn-danger rounded-pill">Adicionar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
