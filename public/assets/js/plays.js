document.addEventListener("DOMContentLoaded", function () {
    let viewModel = new PlayViewModel();
    ko.applyBindings(viewModel);

    function PlayViewModel() {
        var self = this;
        self.plays = ko.observableArray([]);
        self.selectedPlay = ko.observable(null);
        self.newPlay = ko.observable({
            position: ko.observable('UTG'),
            sb: ko.observable(0),
            bb: ko.observable(0),
            ante: ko.observable(0),
            memo: ko.observable(''),
            hand1_rank: ko.observable('2'),
            hand1_suit: ko.observable('spade'),
            hand2_rank: ko.observable('3'),
            hand2_suit: ko.observable('heart'),
            flop1_rank: ko.observable('4'),
            flop1_suit: ko.observable('diamond'),
            flop2_rank: ko.observable('5'),
            flop2_suit: ko.observable('club'),
            flop3_rank: ko.observable('6'),
            flop3_suit: ko.observable('spade'),
            turn_rank: ko.observable('7'),
            turn_suit: ko.observable('heart'),
            river_rank: ko.observable('8'),
            river_suit: ko.observable('diamond')
        });

        // データ取得
        self.loadPlays = function () {
            fetch('/plays/api')
            .then(response => response.json())
            .then(data => {
                console.log("取得データ:", data); // データをコンソールに出力して確認
                data.forEach(play => {
                    if (!play.position) {
                        play.position = "UTG";  // `position` が null の場合の対処
                    }
                });
                self.plays(data);  
            })
            .catch(error => console.error('Error:', error));
        };

        // 削除処理
        self.deletePlay = function (play) {
            if (confirm("本当に削除しますか？")) {
                fetch('/plays/delete/' + play.id, { method: 'POST' })
                    .then(response => response.json())
                    .then(result => {
                        alert(result.message);
                        self.loadPlays();
                    }).catch(error => console.error("Error:", error));
            }
        };

        // 編集モーダルを開く
        self.openEditModal = function (play) {
            self.selectedPlay(play);
            document.getElementById("editModal").style.display = "block";
        };

        // 更新処理
        self.updatePlay = function () {
            let play = ko.toJS(self.selectedPlay());

            fetch('/plays/update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(play)
            }).then(response => response.json())
                .then(result => {
                    alert(result.message);
                    if (result.success) {
                        self.loadPlays();
                        closeEditModal();
                    }
                }).catch(error => console.error("Error:", error));
        };

        // 新規作成処理
        self.createPlay = function() {
            let playData = ko.toJS(self.newPlay);
            console.log("送信データ:",playData); // デバッグ用
    
            fetch('/plays/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(playData)
            })
            .then(response => response.text())
            .then(data => {
                if (data.success) {
                    alert("プレイを作成しました！");
                    location.reload(); // 成功したらページをリロード
                } else {
                    alert("作成に失敗しました: " + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        };

        // 初期データ読み込み
        self.loadPlays();
    }
});

// モーダルを開閉する関数
function openCreateModal() {
    document.getElementById("createModal").style.display = "block";
}

function closeCreateModal() {
    document.getElementById("createModal").style.display = "none";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}