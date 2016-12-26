function onUse(cid, item, frompos, item2, topos)
	rand = math.random(1000)
	if  (rand < 35) then -- 3,5% de chance
		-- crab
	elseif  (rand < 70) then -- 3,5% de chance
		-- female seahorse
	elseif  (rand < 105) then -- 3,5% de chance
		-- male seahorse
	elseif  (rand < 150) then -- 4,5% de chance
		-- eel
	elseif  (rand < 185) then -- 3,5% de chance
		-- moluscle
	elseif  (rand < 220) then -- 3,5% de chance
		-- thunder jellyfish
	elseif  (rand < 270) then -- 5% de chance
		-- shirimp
	elseif  (rand < 305) then -- 3,5% de chance
		-- pirana
	elseif  (rand < 340) then -- 3,5% de chance
		-- jellyfish
	elseif  (rand < 375) then -- 3,5% de chance
		-- povo
	elseif  (rand < 405) then -- 4% de chance
		-- fish
	elseif  (rand < 445) then -- 4% de chance
		-- big fish
	elseif  (rand < 455) then -- 1% de chance
		doPlayerAddItem(cid, 7632, 1) 
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'You have found a giant shimmering blue pearl!')
	elseif  (rand < 470) then -- 1,5% de chance
		doPlayerAddItem(cid, 7633, 1) 
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'You have found a giant shimmering pearl!')
	elseif (rand < 520) then -- 5% de chance
		doPlayerAddItem(cid, 2143, 1) 
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'You have found a white pearl!')
	elseif (rand < 560) then -- 4% de chance
		doPlayerAddItem(cid, 2143, 2)
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'You have found two white pearls!')
	elseif (rand < 590) then -- 3% de chance
		doPlayerAddItem(cid, 2144, 1)
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'You have found a black pearl!')
	elseif (rand < 592) then -- 0,2% de chance
		doPlayerAddItem(cid, 7963, 1)
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'You have found a dead swordfish!')
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, 'It is empty.')
	end
	
	doSendMagicEffect(frompos, 25)
	doTransformItem(item.uid, 7553)
	doDecayItem(item.uid)
	return 1 
end


 -- 3,5 crab
 -- 3,5 seahorse
 -- 3,5 eel
 -- 3,5 pirana
 -- 3,5 jellyfish
 -- 3,5 lula

 -- fish
 -- bigfish
 
 -- thunder jellyfish
 -- slug
 -- bloodcrab
 -- shark
 -- young ness lake monster
 -- ness lake monster
 -- ancient crocodile
 -- waterer crocodile
 -- Lagosta
 
 -- Octopus
 -- Kraken
 
 -- 4 3 3