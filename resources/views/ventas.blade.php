@extends('admin')

@section('contenido')
<style>
    #lista-sugerencias {
        position: absolute;
        z-index: 9999;
        width: 100%;
        max-height: 280px;
        overflow-y: auto;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-radius: 0 0 15px 15px;
        background: white;
    }
    .sugerencia-item { cursor: pointer; transition: all 0.2s; border-bottom: 1px solid #eee; }
    .sugerencia-item:hover { background-color: #f8f9fa; border-left: 5px solid #198754; }
    .table-responsive { min-height: 450px; }
</style>

<div class="container-fluid p-4">
    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4"><i class="fas fa-shopping-cart text-success me-2"></i> Punto de Venta</h2>
            
            <div class="position-relative mb-4">
                <div class="bg-light p-2 rounded-pill border shadow-sm px-4">
                    <div class="input-group input-group-lg border-0">
                        <span class="input-group-text bg-transparent border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" id="busqueda" class="form-control border-0 bg-transparent" 
                               placeholder="Escanee código o escriba nombre..." autocomplete="off" autofocus>
                    </div>
                </div>
                <div id="lista-sugerencias" class="list-group d-none"></div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="table-responsive rounded-4 border bg-white shadow-sm">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">Producto / Info</th>
                                    <th width="120">Cant.</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody id="tabla-carrito"></tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-light border-0 rounded-4 shadow-sm text-center">
                        <div class="card-body p-4">
                            <span class="text-muted small fw-bold text-uppercase">Total Venta</span>
                            <h1 class="display-5 fw-bold text-success mb-4">$ <span id="total-vista">0</span></h1>
                            
                            <div class="text-start mb-3">
                                <label class="small fw-bold text-secondary">Paga con:</label>
                                <input type="number" id="pago_cliente" class="form-control form-control-lg fw-bold text-success border-2" placeholder="0">
                            </div>
                            <div class="text-start mb-4">
                                <label class="small fw-bold text-secondary">Cambio:</label>
                                <input type="text" id="cambio_cliente" class="form-control form-control-lg bg-white fw-bold text-primary border-0 shadow-sm" readonly value="$ 0">
                            </div>

                            <button class="btn btn-dark btn-lg w-100 py-3 fw-bold rounded-3 shadow" onclick="ejecutarCobro()">
                                <i class="fas fa-check-circle me-2"></i> FINALIZAR VENTA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let carrito = [];
let totalVenta = 0;
const inputBusqueda = document.getElementById('busqueda');
const listaSugerencias = document.getElementById('lista-sugerencias');

// Listener de búsqueda
inputBusqueda.addEventListener('input', async (e) => {
    const term = e.target.value.trim();
    if (term.length < 1) {
        listaSugerencias.classList.add('d-none');
        return;
    }

    try {
        // CORRECCIÓN: Usar ruta por nombre de Laravel
        const res = await fetch(`{{ route('ventas.buscar') }}?term=${encodeURIComponent(term)}`);
        const data = await res.json();
        
        if (data.success && data.productos.length > 0) {
            // Auto-agregar si el código de barras coincide exactamente
            if (data.productos.length === 1 && (data.productos[0].codigo_barras === term)) {
                agregarAlCarrito(data.productos[0]);
                inputBusqueda.value = "";
                listaSugerencias.classList.add('d-none');
                return;
            }

            listaSugerencias.innerHTML = "";
            listaSugerencias.classList.remove('d-none');

            data.productos.forEach(p => {
                const item = document.createElement('div');
                item.className = "list-group-item list-group-item-action sugerencia-item p-3";
                item.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-dark">${p.nombre}</strong><br>
                            <small class="text-muted">ID: ${p.id} | <i class="fas fa-barcode"></i> ${p.codigo_barras}</small>
                        </div>
                        <div class="text-success fw-bold">$${parseFloat(p.precio_venta || 0).toLocaleString()}</div>
                    </div>`;
                
                item.onclick = () => {
                    agregarAlCarrito(p);
                    inputBusqueda.value = "";
                    listaSugerencias.classList.add('d-none');
                    inputBusqueda.focus();
                };
                listaSugerencias.appendChild(item);
            });
        } else {
            listaSugerencias.classList.add('d-none');
        }
    } catch (err) { 
        console.error("Error en la búsqueda:", err); 
    }
});

function agregarAlCarrito(p) {
    if(parseInt(p.stock) <= 0) return alert("Producto sin stock disponible");
    
    let existente = carrito.find(item => item.producto_id === p.id);
    if(existente) {
        if(existente.cantidad < p.stock) {
            existente.cantidad++;
        } else {
            alert("Has alcanzado el límite de stock disponible");
        }
    } else {
        carrito.push({
            fila_id: Date.now() + Math.random(),
            producto_id: p.id,
            codigo_barras: p.codigo_barras,
            nombre: p.nombre,
            precio_venta: parseFloat(p.precio_venta || 0),
            cantidad: 1,
            stock_max: p.stock
        });
    }
    actualizarInterfaz();
}

function actualizarInterfaz(){
    const tbody = document.getElementById('tabla-carrito');
    tbody.innerHTML = "";
    totalVenta = 0;

    carrito.forEach(item => {
        let sub = item.precio_venta * item.cantidad;
        totalVenta += sub;
        tbody.innerHTML += `
            <tr>
                <td class="ps-4">
                    <div class="fw-bold">${item.nombre}</div>
                    <small class="text-muted">Barras: ${item.codigo_barras}</small>
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-center" 
                           value="${item.cantidad}" min="1" max="${item.stock_max}"
                           onchange="cambiarCant(${item.fila_id}, this.value)" style="width: 80px;">
                </td>
                <td>$${item.precio_venta.toLocaleString()}</td>
                <td class="fw-bold text-success">$${sub.toLocaleString()}</td>
                <td>
                    <button class="btn btn-sm text-danger" onclick="quitar(${item.fila_id})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>`;
    });

    document.getElementById('total-vista').innerText = totalVenta.toLocaleString();
    calcularVuelto();
}

function cambiarCant(fid, n){
    let i = carrito.find(x => x.fila_id == fid);
    let nuevaCant = parseInt(n);
    if(i && nuevaCant > 0) {
        if(nuevaCant <= i.stock_max) {
            i.cantidad = nuevaCant;
        } else {
            alert("Solo hay " + i.stock_max + " unidades disponibles");
            i.cantidad = i.stock_max;
        }
    }
    actualizarInterfaz();
}

function quitar(fid){
    carrito = carrito.filter(x => x.fila_id !== fid);
    actualizarInterfaz();
}

document.getElementById('pago_cliente').addEventListener('input', calcularVuelto);

function calcularVuelto(){
    const pago = parseFloat(document.getElementById('pago_cliente').value) || 0;
    const vuelto = pago - totalVenta;
    document.getElementById('cambio_cliente').value = vuelto >= 0 ? "$ " + vuelto.toLocaleString() : "$ 0";
}

async function ejecutarCobro(){
    if(carrito.length === 0) return alert("El carrito está vacío");
    const pago = parseFloat(document.getElementById('pago_cliente').value) || 0;
    if(pago < totalVenta) return alert("El monto pagado es menor al total");

    try {
        const res = await fetch("{{ route('ventas.store') }}", {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ total: totalVenta, productos: carrito })
        });
        
        const d = await res.json();
        if(d.success) { 
            alert("¡Venta realizada con éxito!"); 
            location.reload(); 
        } else {
            alert("Error al procesar la venta: " + (d.message || "Desconocido"));
        }
    } catch (err) {
        console.error("Error en la petición:", err);
        alert("Hubo un error de conexión con el servidor.");
    }
}

// Cerrar sugerencias al hacer clic fuera
document.addEventListener('click', (e) => {
    if(!inputBusqueda.contains(e.target) && !listaSugerencias.contains(e.target)) {
        listaSugerencias.classList.add('d-none');
    }
});
</script>
@endsection