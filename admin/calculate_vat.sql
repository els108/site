USE site;

DELIMITER //

DROP FUNCTION IF EXISTS calculate_vat//

CREATE DEFINER=`root`@`localhost` FUNCTION calculate_vat(amount DECIMAL(10,2))
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    RETURN amount * 0.20; -- 20% НДС
END//

DELIMITER ; 