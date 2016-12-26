function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 137;

	itemweight = getItemWeightById(1988, 1);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	itemweight = itemweight + getItemWeightById(3976, 100);
	
	-- verificando se o jogador já pegou o item antes
	if (true == false) then
		if (getPlayerStorageValue(cid, actionid) < 1) then
			-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
			if (itemweight <= getPlayerFreeCap(cid)) then
				doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a brass set.");
				-- considerando o items já pego
				doPlayerSetStorageValue(cid, actionid, 1);
				-- adicionando items
				local bag = doPlayerAddItem(cid, 1988);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
				doAddContainerItem(bag, 3976, 100);
			else
				doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a brass set, it weights " .. itemweight .. "oz, you have not cap.")
			end
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a backpack full of worms, you don't need it right now.")
	end
	return true
end