INSERT INTO rooms (
    type_room_id,
    client_id,
    number,
    price,
    price_air,
    frozen,
    number_facture,
    state

)
VALUES  (1,null,201,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,202,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,203,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,204,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,205,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,206,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,207,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,208,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,209,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,210,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,211,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,301,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,302,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,303,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,304,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,305,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,306,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,307,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,308,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,309,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,310,25000,55000,'Ventilador',null,'Disponible'),
        (1,null,311,25000,55000,'Ventilador',null,'Disponible');
INSERT INTO providers (
    name_provider,
    firstSurname_provider,
    secondSurname_provider,
    company_provider,
    address_provider,
    phone_provider,
    email_provider,
    nit_provider
)
VALUES  ('Nombre','primer apellido','segundo apellido','DISTRIBUCIONES MVM S.A.S','dirección','celular','E-mail','900662046-3'), 
        ('Nombre','primer apellido','segundo apellido','SURTIELECTRICOS','dirección','celular','E-mail','901093999-9'), 
        ('Nombre','primer apellido','segundo apellido','COMERCIALIZADORA PROQUIMEL LTDA','dirección','celular','E-mail','900147334-1'), 
        ('Nombre','primer apellido','segundo apellido','OLIMPICA S.A','dirección','celular','E-mail','890.107.487-3'), 
        ('Nombre','primer apellido','segundo apellido','RH SAS','dirección','celular','E-mail','805007083-3'), 
        ('Nombre','primer apellido','segundo apellido','MADECENTRO COLOMBIA SAS','dirección','celular','E-mail','811028650'), 
        ('Nombre','primer apellido','segundo apellido','NELSON DARIO LONDOÑO','dirección','celular','E-mail','16.216.872-2'), 
        ('Nombre','primer apellido','segundo apellido','GRUPO CLEAN  SAS','dirección','celular','E-mail','901.145.668-0'), 
        ('Nombre','primer apellido','segundo apellido','INVERSIONES RENDON VALENCIA GONZALEZ','dirección','celular','E-mail','900.190.237-7'), 
        ('Nombre','primer apellido','segundo apellido','DISTRIPLAST CARTAGO S.A.S','dirección','celular','E-mail','901200787-4'), 
        ('Nombre','primer apellido','segundo apellido','ALMACENES ÉXITO S.A','dirección','celular','E-mail','890.900.608-9'), 
        ('Nombre','primer apellido','segundo apellido','SODIMAC COLOMBIA S.A','dirección','celular','E-mail','800.242.106-2'), 
        ('Nombre','primer apellido','segundo apellido','JAIRO BERNAL HERNANDEZ(EXTINTORES)','dirección','celular','E-mail','10.118.349-1'), 
        ('Nombre','primer apellido','segundo apellido','JUAN DAVID CASTAÑEDA','dirección','celular','E-mail','1,112771646-2'), 
        ('Nombre','primer apellido','segundo apellido','MARIA SOFIA VILLEGAS','dirección','celular','E-mail','29.377.118-4'), 
        ('Nombre','primer apellido','segundo apellido','OLGA LUCIA ISAZA','dirección','celular','E-mail','31.418.362-1'), 
        ('Nombre','primer apellido','segundo apellido','DAVID BEDOYA','dirección','celular','E-mail','1112758255-2'), 
        ('Nombre','primer apellido','segundo apellido','MORALES FALLA Y CIA','dirección','celular','E-mail','900.211.248-1'),
        ('Nombre','primer apellido','segundo apellido','SANDRA INES DUQUE GOMEZ','dirección','celular','E-mail','31.427.910-4'); 
INSERT INTO products (
    category_id,
    provider_id,
    name_product,
    img_product,
    stock_product,
    start_product,
    buy_product,
    sale_product,
    condition_product
)
VALUES  (1,1,'GASEOSA','gaseosas.jpg',10,10,2500,2500,1),
        (1,1,'MR TEA','mrTea.jpg',10,10,2500,2500,1),
        (1,1,'MALTA','malta.png',10,10,2500,2500,1),
        (1,1,'AGUA BOTELLA','brisa.png',10,10,2500,2500,1),
        (1,1,'GETORADE','gatorade.jpg',10,10,3500,3500,1),
        (1,1,'H2O','h2o.jpg',10,10,3500,3500,1),
        (1,1,'CERVEZAS','cervezas.jpg',10,10,3500,3500,1),
        (1,1,'GASEOSA 2LTS POSTOBON','postobon.jpg',10,10,4000,4000,1),
        (1,1,'GASEOSA COCACOLA 1.5LTS','cocacola.jpg',10,10,4500,4500,1),
        (1,1,'CHAMPAÑA','champana.jpg',10,10,15000,15000,1),
        (1,1,'VINO','vino.jpg',10,10,25000,25000,1),
        (1,1,'HIT','hit.png',10,10,2500,2500,1),
        (1,1,'PASABOCAS','logo.png',10,10,1800,1800,1),
        (1,1,'SALCHICHAS','logo.png',10,10,4500,4500,1),
        (1,1,'CHOCOLATINA','logo.png',10,10,1700,1700,1),
        (1,1,'MANIMOTO','logo.png',10,10,1700,1700,1),
        (1,1,'MINICHIPS','logo.png',10,10,1700,1700,1),
        (1,1,'CREMA DENTAL','logo.png',10,10,2500,2500,1),
        (1,1,'CEPILLO DE DIENTES','logo.png',10,10,3500,3500,1),
        (1,1,'SHAMPOO','logo.png',10,10,2000,2000,1),
        (1,1,'CREMA PARA PEINAR','logo.png',10,10,2000,2000,1),
        (1,1,'GEL','logo.png',10,10,2500,2500,1),
        (1,1,'PRESERVATIVOS X 3 UND','logo.png',10,10,6000,6000,1),
        (1,1,'PRESTOBARBA','logo.png',10,10,4000,4000,1),
        (1,1,'DESODORANTE','logo.png',10,10,2000,2000,1),
        (1,1,'BONFIEST','logo.png',10,10,3000,3000,1),
        (1,1,'DETODITO','logo.png',10,10,2200,2200,1);

DELIMITER //
CREATE TRIGGER updStockCompraAnular AFTER INSERT ON sales FOR EACH ROW
BEGIN
  UPDATE products p
    JOIN sales sa
      ON sa.product_id = p.id
     AND sa.id = new.id
     set p.stock_product = p.stock_product - sa.quantity_sales;
end;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER stockBuy AFTER INSERT ON buys FOR EACH ROW 
BEGIN
  UPDATE products p
    JOIN buys bu
      ON bu.product_id = p.id
     AND bu.id= new.id
     set p.stock_product = p.stock_product + bu.quantity_buy;
end;
//
DELIMITER ;









