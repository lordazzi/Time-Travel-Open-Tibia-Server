function onUse(cid, item, frompos, item2, topos)
            doTransformItem(item.uid,4008)
            doPlayerAddItem(cid, 2675, math.random(10))
            doDecayItem(item.uid)
      return 1 
end