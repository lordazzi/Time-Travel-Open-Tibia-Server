function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 144;

	itemweight = getItemWeightById(1988, 1);
	itemweight = itemweight + getItemWeightById(7876, 1);
	itemweight = itemweight + getItemWeightById(7856, 1);
	itemweight = itemweight + getItemWeightById(7775, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a brass set.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1988);
			doAddContainerItem(bag, 7876, 100);
			doAddContainerItem(bag, 7856, 100);
			doAddContainerItem(bag, 7775, 100);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a brass set, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end