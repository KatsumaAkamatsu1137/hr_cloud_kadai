<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プレイ履歴一覧</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"></script>
    <script src="/assets/js/plays.js"></script>
</head>
<body>
    <h1>プレイ履歴一覧</h1>
    <button onclick="openCreateModal()">新規プレイ追加</button>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ポジション</th>
            <th>SB</th>
            <th>BB</th>
            <th>ハンド</th>
            <th>ボード</th>
            <th>アクション</th>
        </tr>
        <tbody data-bind="foreach: plays">
            <tr>
                <td data-bind="text: id"></td>
                <td data-bind="text: position"></td>
                <td data-bind="text: sb"></td>
                <td data-bind="text: bb"></td>
                <td>
                    <span data-bind="foreach: cards">
                        <!-- ハンドのカードのみ表示 -->
                        <!-- ko if: type === 'hand' -->
                        <span data-bind="text: card_rank"></span><span data-bind="text: suit"></span>
                        <!-- /ko -->
                    </span>
                </td>
                <td>
                    <span data-bind="foreach: cards">
                        <!-- フロップ、ターン、リバーのカードのみ表示 -->
                        <!-- ko if: type !== 'hand' -->
                        <span data-bind="text: card_rank"></span><span data-bind="text: suit"></span>
                        <!-- /ko -->
                    </span>
                </td>
                <td>
                    <a data-bind="attr: { href: '/plays/view/' + id }">詳細</a> |
                    <a href="#" data-bind="click: $parent.openEditModal">編集</a> |
                    <button data-bind="click: $parent.deletePlay">削除</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 新規プレイ作成モーダル -->
    <div id="createModal" style="display:none;">
        <h2>新規プレイ作成</h2>
        <form data-bind="submit: createPlay">
            <label>ポジション:
                <select data-bind="value: newPlay().position">
                    <option value="UTG">UTG</option>
                    <option value="MP">MP</option>
                    <option value="CO">CO</option>
                    <option value="BTN">BTN</option>
                    <option value="SB">SB</option>
                    <option value="BB">BB</option>
                </select>
            </label>
            <br>
            <label>SB: <input type="number" data-bind="value: newPlay().sb" /></label>
            <label>BB: <input type="number" data-bind="value: newPlay().bb" /></label>
            <label>アンティ: <input type="number" data-bind="value: newPlay().ante" /></label>
            <label>メモ: <input type="text" data-bind="value: newPlay().memo" /></label>
            <br><br>

            <h3>ハンド選択</h3>

            <!-- ハンド1 -->
            <label>1枚目:
                <select data-bind="value: newPlay().hand1_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().hand1_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>

            <!-- ハンド2 -->
            <label>2枚目:
                <select data-bind="value: newPlay().hand2_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().hand2_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>

            <h3>ボード選択</h3>

            <!-- フロップ1 -->
            <label>フロップ1:
                <select data-bind="value: newPlay().flop1_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().flop1_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <!-- フロップ2 -->
            <label>フロップ2:
                <select data-bind="value: newPlay().flop2_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().flop2_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <!-- フロップ3 -->
            <label>フロップ3:
                <select data-bind="value: newPlay().flop3_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().flop3_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <!-- ターン -->
            <label>ターン:
                <select data-bind="value: newPlay().turn_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().turn_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <!-- リバー -->
            <label>リバー:
                <select data-bind="value: newPlay().river_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: newPlay().river_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>

            <button type="button" onclick="closeCreateModal()">閉じる</button>
            <button type="submit">作成</button>
        </form>
    </div>

    <!-- 編集モーダル -->
    <div id="editModal" style="display:none;">
        <h2>プレイ編集</h2>
        <form data-bind="submit: updatePlay">
            <label>ポジション:
                <select data-bind="value: selectedPlay().position">
                    <option value="UTG">UTG</option>
                    <option value="MP">MP</option>
                    <option value="CO">CO</option>
                    <option value="BTN">BTN</option>
                    <option value="SB">SB</option>
                    <option value="BB">BB</option>
                </select>
            </label>
            <br>
            <label>SB: <input type="number" data-bind="value: selectedPlay().sb" /></label>
            <label>BB: <input type="number" data-bind="value: selectedPlay().bb" /></label>
            <label>アンティ: <input type="number" data-bind="value: selectedPlay().ante" /></label>
            <label>メモ: <input type="text" data-bind="value: selectedPlay().memo" /></label>
            <br><br>

            <h3>ハンド選択</h3>
            <!-- ハンド1 -->
            <label>1枚目:
                <select data-bind="value: selectedPlay().hand1_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().hand1_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <!-- ハンド2 -->
            <label>2枚目:
                <select data-bind="value: selectedPlay().hand2_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().hand2_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>            

            <h3>ボード選択</h3>
            <label>フロップ1:
                <select data-bind="value: selectedPlay().flop1_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().flop1_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <label>フロップ2:
                <select data-bind="value: selectedPlay().flop2_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().flop2_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <label>フロップ3:
                <select data-bind="value: selectedPlay().flop3_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().flop3_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <label>ターン:
                <select data-bind="value: selectedPlay().turn_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().turn_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>
            <label>リバー:
                <select data-bind="value: selectedPlay().river_rank">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="J">J</option>
                    <option value="Q">Q</option>
                    <option value="K">K</option>
                    <option value="A">A</option>
                </select>
                <select data-bind="value: selectedPlay().river_suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </label>
            <br>

            <button type="button" onclick="closeEditModal()">閉じる</button>
            <button type="submit">更新</button>
        </form>
    </div>
</body>
</html>