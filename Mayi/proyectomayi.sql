CREATE TABLE `articulos` (
  `IdArticulo` int(11) NOT NULL,
  `IdPedido` int(11) NOT NULL,
  `Referencia` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Costo` decimal(8,2) NOT NULL,
  `PrecioRealPesos` decimal(8,2) NOT NULL,
  `Utilidad` decimal(3,1) NOT NULL,
  `PVP` decimal(8,1) NOT NULL,
  `Foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `categorias` (
  `IdCategoria` int(11) NOT NULL,
  `Descripcion` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `clientes` (
  `IdCliente` int(11) NOT NULL,
  `NombreCliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Deuda` int(11) DEFAULT NULL,
  `SaldoaFavor` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `pedidos` (
  `IdPedido` int(11) NOT NULL,
  `Valor` decimal(5,2) NOT NULL,
  `ValorEnvio` decimal(8,2) NOT NULL,
  `Dolar` decimal(8,2) NOT NULL,
  `Incremento` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `registro_pagos` (
  `IdRegistro` int(11) NOT NULL,
  `IdVenta` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `Pago` decimal(8,2) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `usuarios` (
  `usuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `ventas` (
  `IdVenta` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdArticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `articulos`
  ADD PRIMARY KEY (`IdArticulo`),
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdCategoria` (`IdCategoria`);

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCategoria`);

ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IdCliente`);

ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`IdPedido`);

ALTER TABLE `registro_pagos`
  ADD PRIMARY KEY (`IdRegistro`),
  ADD KEY `IdVenta` (`IdCliente`),
  ADD KEY `IdVenta_2` (`IdVenta`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

ALTER TABLE `ventas`
  ADD PRIMARY KEY (`IdVenta`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdArticulo` (`IdArticulo`);

ALTER TABLE `articulos`
  MODIFY `IdArticulo` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `categorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `clientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pedidos`
  MODIFY `IdPedido` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `registro_pagos`
  MODIFY `IdRegistro` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ventas`
  MODIFY `IdVenta` int(11) NOT NULL AUTO_INCREMENT;
