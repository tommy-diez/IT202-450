SELECT * FROM Products WHERE name like CONCAT('%', :thing, '%')
ORDER BY :order ASC
