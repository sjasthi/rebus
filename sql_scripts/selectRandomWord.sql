SELECT word_id
FROM characters 
WHERE word_id IN (SELECT word_id FROM words WHERE word_id <> rep_id)
AND word_id >= 
(SELECT FLOOR( MAX(word_id) * RAND()) FROM characters) 
AND character_value = 'm'
ORDER BY word_id LIMIT 1;