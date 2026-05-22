<?php
$productos = [
    [
        "id" => 1,
        "nombre" => "Smartphone Galaxy A05",
        "descripcion" => "Teléfono inteligente con pantalla amplia, buena batería y cámara principal.",
        "precio" => 145.00,
        "categoria" => "Celulares",
        "imagen" => "assets/img/celular.jpg"
    ],
    [
        "id" => 2,
        "nombre" => "Audífonos Bluetooth",
        "descripcion" => "Audífonos inalámbricos con estuche de carga y sonido de buena calidad.",
        "precio" => 22.50,
        "categoria" => "Accesorios",
        "imagen" => "assets/img/audifonos.jpg"
    ],
    [
        "id" => 3,
        "nombre" => "Mouse Inalámbrico",
        "descripcion" => "Mouse ergonómico inalámbrico, ideal para estudio, oficina y uso diario.",
        "precio" => 12.00,
        "categoria" => "Accesorios",
        "imagen" => "assets/img/mouse.jpg"
    ],
    [
        "id" => 4,
        "nombre" => "Cargador Tipo C",
        "descripcion" => "Cargador rápido compatible con dispositivos Android de entrada Tipo C.",
        "precio" => 10.00,
        "categoria" => "Cargadores",
        "imagen" => "assets/img/cargador.jpg"
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 3 - Carrito de Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f3f4f6;
            color: #222;
        }

        header {
            background: #1f2937;
            color: white;
            text-align: center;
            padding: 25px;
        }

        header h1 {
            margin-bottom: 8px;
        }

        .contenedor {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .filtro {
            margin-bottom: 25px;
            text-align: center;
        }

        .filtro label {
            font-weight: bold;
            margin-right: 10px;
        }

        .filtro select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #aaa;
        }

        .productos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .producto {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .producto img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .producto h3 {
            margin-bottom: 10px;
            color: #111827;
        }

        .producto p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .precio {
            font-size: 20px;
            font-weight: bold;
            color: #047857;
            margin-bottom: 12px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1d4ed8;
        }

        .carrito {
            background: white;
            margin-top: 35px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .carrito h2 {
            margin-bottom: 15px;
        }

        .carrito ul {
            list-style: none;
            margin-bottom: 15px;
        }

        .carrito li {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            color: #047857;
        }

        footer {
            text-align: center;
            background: #1f2937;
            color: white;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<header>
    <h1>Práctica 3 - Lista de Productos</h1>
    <p>Ejercicio con HTML, CSS, JavaScript y PHP</p>
</header>

<main class="contenedor">

    <section class="filtro">
        <label for="categoria">Menú desplegable:</label>

        <select id="categoria">
            <option value="Todos">Todos los productos</option>
            <option value="Celulares">Celulares</option>
            <option value="Accesorios">Accesorios</option>
            <option value="Cargadores">Cargadores</option>
        </select>
    </section>

    <section class="productos">
        <?php foreach ($productos as $producto): ?>
            <div class="producto" data-categoria="<?php echo $producto['categoria']; ?>">
                
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">

                <h3><?php echo $producto['nombre']; ?></h3>

                <p><?php echo $producto['descripcion']; ?></p>

                <div class="precio">
                    $<?php echo number_format($producto['precio'], 2); ?>
                </div>

                <button onclick="agregarAlCarrito('<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>)">
                    Agregar al carrito
                </button>

            </div>
        <?php endforeach; ?>
    </section>

    <section class="carrito">
        <h2>Carrito de compras</h2>

        <ul id="lista-carrito">
            <li>No hay productos en el carrito.</li>
        </ul>

        <p class="total">Total: $<span id="total">0.00</span></p>
    </section>

</main>

<footer>
    <p>Desarrollado por Mario Intriago</p>
</footer>

<script>
    let carrito = [];
    let total = 0;

    function agregarAlCarrito(nombre, precio) {
        carrito.push({
            nombre: nombre,
            precio: precio
        });

        total += precio;
        mostrarCarrito();
    }

    function mostrarCarrito() {
        const lista = document.getElementById("lista-carrito");
        const totalElemento = document.getElementById("total");

        lista.innerHTML = "";

        carrito.forEach(function(producto) {
            const item = document.createElement("li");
            item.textContent = producto.nombre + " - $" + producto.precio.toFixed(2);
            lista.appendChild(item);
        });

        totalElemento.textContent = total.toFixed(2);
    }

    const selectCategoria = document.getElementById("categoria");

    selectCategoria.addEventListener("change", function() {
        const categoriaSeleccionada = this.value;
        const productos = document.querySelectorAll(".producto");

        productos.forEach(function(producto) {
            const categoriaProducto = producto.getAttribute("data-categoria");

            if (categoriaSeleccionada === "Todos" || categoriaSeleccionada === categoriaProducto) {
                producto.style.display = "block";
            } else {
                producto.style.display = "none";
            }
        });
    });
</script>

</body>
</html>