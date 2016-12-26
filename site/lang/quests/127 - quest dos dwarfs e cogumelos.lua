function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 127;

	itemweight = getItemWeightById(18393, 1);
	itemweight = itemweight + getItemWeightById(2787, 15);
	itemweight = itemweight + getItemWeightById(2788, 15);
	itemweight = itemweight + getItemWeightById(2795, 20);
	itemweight = itemweight + getItemWeightById(2796, 20);
	itemweight = itemweight + getItemWeightById(2789, 25);
	itemweight = itemweight + getItemWeightById(2280, 1);
	itemweight = itemweight + getItemWeightById(2280, 1);
	itemweight = itemweight + getItemWeightById(2280, 1);
	itemweight = itemweight + getItemWeightById(2280, 1);
	itemweight = itemweight + getItemWeightById(2435, 1);
	itemweight = itemweight + getItemWeightById(7886, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full mushroom backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 18393);
			doAddContainerItem(bag, 2787, 15);
			doAddContainerItem(bag, 2788, 15);
			doAddContainerItem(bag, 2795, 20);
			doAddContainerItem(bag, 2796, 20);
			doAddContainerItem(bag, 2789, 25);
			doAddContainerItem(bag, 2280);
			doAddContainerItem(bag, 2280);
			doAddContainerItem(bag, 2280);
			doAddContainerItem(bag, 2280);
			doAddContainerItem(bag, 2435);
			doAddContainerItem(bag, 7886);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full mushroom backpack, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end