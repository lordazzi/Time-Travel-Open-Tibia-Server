function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 101;
	-- item = 2383, 2300, 2146x5
	itemweight = (getItemWeightById(1995, 1) + getItemWeightById(2383, 1) + getItemWeightById(2300, 1) + getItemWeightById(2146, 5));

	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a bag with an Spike Sword.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1995);
			doAddContainerItem(bag, 2383);
			doAddContainerItem(bag, 2300);
			doAddContainerItem(bag, 2146, 5);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end