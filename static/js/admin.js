document.addEventListener('DOMContentLoaded', () => {
    let menu = JSON.parse(document.querySelector('.menuData').value);

    let nodesCount = node => {
        let lastNode = node => {
            if (node.childrens.length === 0) {
                return node;
            }

            const lastID = node.childrens.length - 1;
            return lastNode(node.childrens[lastID]);
        };

        return lastNode(node).order - node.order + 1;
    };

    let reorder = (node, func) => {
        node.order = func(node.order);
        node.childrens.forEach(child => {
            reorder(child, func);
        });
    };

    document.querySelectorAll('.menu-up').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            let id = e.target.parentNode.dataset.id;

            let findNodes = (menu, id) => {
                for (let i = 0; i < menu.length; i++) {
                    if (menu[i].id === id) {
                        if (i >= 1) {
                            return [menu[i-1], menu[i]];
                        } else {
                            return undefined;
                        }
                    } else if (menu[i].childrens.length > 0) {
                        let res = findNodes(menu[i].childrens, id);
                        if (res !== undefined) {
                            return res;
                        }
                    }
                }
            };

            let nodes = findNodes(menu, id);
            if (nodes === undefined) {
                return;
            }

            const nodes0Count = nodesCount(nodes[0]);
            const nodes1Count = nodesCount(nodes[1]);
            
            reorder(nodes[0], i => +i + nodes1Count);
            reorder(nodes[1], i => i - nodes0Count);

            document.querySelector('.menuData').value = JSON.stringify(menu);
            document.querySelector('.menuDataForm').submit();
        });
    });

    document.querySelectorAll('.menu-down').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            let id = e.target.parentNode.dataset.id;

            let findNodes = (menu, id) => {
                for (let i = 0; i < menu.length; i++) {
                    if (menu[i].id === id) {
                        if (i <= menu.length - 1) {
                            return [menu[i], menu[i + 1]];
                        } else {
                            return undefined;
                        }
                    } else if (menu[i].childrens.length > 0) {
                        let res = findNodes(menu[i].childrens, id);
                        if (res !== undefined) {
                            return res;
                        }
                    }
                }
            };

            let nodes = findNodes(menu, id);
            if (nodes === undefined) {
                return;
            }

            const nodes0Count = nodesCount(nodes[0]);
            const nodes1Count = nodesCount(nodes[1]);
            
            reorder(nodes[0], i => +i + nodes1Count);
            reorder(nodes[1], i => i - nodes0Count);

            document.querySelector('.menuData').value = JSON.stringify(menu);
            document.querySelector('.menuDataForm').submit();
        });
    });

    document.querySelectorAll('.menu-delete').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            
        });
    });
});