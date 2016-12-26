function onUse(cid, item, fromPosition, itemEx, toPosition)
	local pos = getCreaturePosition(cid);

	if (item.itemid == 2633) then -- Uka Uka - maligno
		local uka = doSummonCreature("Uka Uka", pos);
		if (isCreature(uka)) then
			doRemoveItem(item.uid);
			return true;
		else
			doSendMagicEffect(getPlayerPosition(cid), CONST_ME_POFF);
			doPlayerSendCancel(cid, "Can't summon.");
			return 0;
		end
	elseif (item.itemid == 2628) then -- Aku Aku
		for i, j in ipairs(getCreatureSummons(cid)) do
			if (getCreatureName(j) == 'Aku Aku') then
				doPlayerSendCancel(cid, "You already have summoned the Aku Aku.");
				return 0;
			end
		end
		
		local uka = doSummonCreature("Aku Aku", pos);
		doCreatureSay(uka, "Buga! Turu tutu...", MESSAGE_EVENT_ORANGE);
		if (isCreature(uka)) then
			doTransformItem(item.uid, 2627, 1);
			doConvinceCreature(cid, uka);
			doDecayItem(item.uid);
			return true;
		else
			doSendMagicEffect(getPlayerPosition(cid), CONST_ME_POFF);
			doPlayerSendCancel(cid, "Can't summon.");
			return 0;
		end
	elseif (item.itemid == 2630) then -- Aku Aku duplo
		for i, j in ipairs(getCreatureSummons(cid)) do
			if (getCreatureName(j) == 'Aku Aku') then
				doPlayerSendCancel(cid, "You already have summoned the Aku Aku.");
				return 0;
			end
		end
		
		local uka = doSummonCreature("Double Aku Aku", pos);
		doCreatureSay(uka, "Buga! Turu tutu...", MESSAGE_EVENT_ORANGE);
		if (isCreature(uka)) then
			doTransformItem(item.uid, 2629, 1);
			doConvinceCreature(cid, uka);
			doDecayItem(item.uid);
			return true;
		else
			doSendMagicEffect(getPlayerPosition(cid), CONST_ME_POFF);
			doPlayerSendCancel(cid, "Can't summon.");
			return 0;
		end
	end
end