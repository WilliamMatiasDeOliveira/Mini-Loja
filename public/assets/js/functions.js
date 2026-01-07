
// function previewImages(input) {
//     const container = document.getElementById('preview-container');
//     container.innerHTML = '';

//     if (!input.files) return;

//     Array.from(input.files).forEach((file, index) => {
//         const reader = new FileReader();

//         reader.onload = function (e) {
//             const col = document.createElement('div');
//             col.className = 'col-md-3';

//             col.innerHTML = `
//                 <div class="card h-100">
//                     <img src="${e.target.result}" class="card-img-top" style="object-fit:cover;height:180px;">
//                     <div class="card-body p-2 text-center">
//                         <small class="text-muted">
//                             ${index === 0 ? 'Imagem principal' : 'Imagem secundária'}
//                         </small>
//                     </div>
//                 </div>
//             `;

//             container.appendChild(col);
//         };

//         reader.readAsDataURL(file);
//     });
// }


const imagensInput = document.getElementById('imagensInput');
const previewContainer = document.getElementById('preview-container');

let arquivos = new DataTransfer();

imagensInput.addEventListener('change', function () {

    Array.from(this.files).forEach(file => {
        arquivos.items.add(file);
        renderPreview(file, arquivos.items.length - 1);
    });

    // Atualiza o input com TODOS os arquivos acumulados
    imagensInput.files = arquivos.files;
});

function renderPreview(file, index) {
    const reader = new FileReader();

    reader.onload = function (e) {
        const col = document.createElement('div');
        col.className = 'col-md-3';

        col.innerHTML = `
            <div class="card h-100">
                <img src="${e.target.result}" class="card-img-top"
                     style="height:180px;object-fit:contain">
                <div class="card-body p-2 text-center">
                    <small class="text-muted">
                        ${index === 0 ? 'Imagem principal' : 'Imagem secundária'}
                    </small>
                </div>
            </div>
        `;

        previewContainer.appendChild(col);
    };

    reader.readAsDataURL(file);
}
