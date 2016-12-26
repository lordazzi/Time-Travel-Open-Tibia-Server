function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 103;
	-- item = 9676
	itemweight = getItemWeightById(9676, 1);
	
	if (true == false) then
		-- verificando se o jogador já pegou o item antes
		if (getPlayerStorageValue(cid, actionid) < 1) then
			-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
			if (itemweight <= getPlayerFreeCap(cid)) then
				doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found delicious bee honey.");
				-- considerando o items já pego
				doPlayerSetStorageValue(cid, actionid, 1);
				-- adicionando items
				doPlayerAddItem(cid, 9676);
			else
				doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found delicious bee honey, it weights " .. itemweight .. ", you have not cap.")
			end
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found delicious bee honey, but you don't need it right now.");
	end
	return true
end