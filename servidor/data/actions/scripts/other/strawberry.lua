function onUse(cid, item, frompos, item2, topos)
            doTransformItem(item.uid, 2786)
            doPlayerAddItem(cid, 2680, math.random(7))
            doDecayItem(item.uid)
      return 1 
end