local VIALS = { 2006, 11396 };
local FLASKS = { 7634, 7635, 7636 };

function onUse(cid, item, fromPosition, itemEx, toPosition)
	if (isInArray(FLASKS, itemEx.itemid)) then
		doPlayerAddMoney(cid, 5*itemEx.type)
		doPlayerRemoveItem(cid, 2307, 1);
		doRemoveItem(itemEx.uid);
		return true;
	elseif (isInArray(VIALS, itemEx.itemid) and itemEx.type == 0) then
		doPlayerAddMoney(cid, 5);
		doPlayerRemoveItem(cid, 2307, 1);
		doRemoveItem(itemEx.uid);
		return true;
	else
		return doPlayerSendCancel(cid, 'You can use this rune on empty vials and flasks.');
	end
end