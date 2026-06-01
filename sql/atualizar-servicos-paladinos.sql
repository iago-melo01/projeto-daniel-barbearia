-- Execute no phpMyAdmin se o banco já existir (Barbearia Paladinos)
USE `barbearia`;

UPDATE `servicos` SET `preco` = 30.00 WHERE `servico` = 'Corte Masculino';
UPDATE `servicos` SET `preco` = 50.00 WHERE `servico` = 'Corte + Barba';
UPDATE `servicos` SET `preco` = 45.00 WHERE `servico` = 'Corte + Sobrancelha';

DELETE FROM `servicos` WHERE `servico` IN ('Barba Completa', 'Relaxamento Capilar');
