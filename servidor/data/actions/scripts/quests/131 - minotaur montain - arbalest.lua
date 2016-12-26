function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 131;
	item = 5803
	itemweight = getItemWeightById(item, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a " .. getItemNameById(item) .. ".");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			doPlayerAddItem(cid, item);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a " .. getItemNameById(item) .. ", it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end