use ics325;

SELECT words.word_value, words.word_id, words.rep_id, characters.character_value
FROM characters natural join words
WHERE word_id IN (SELECT word_id FROM words WHERE word_id <> rep_id)
AND character_value = 'z'
GROUP BY word_id