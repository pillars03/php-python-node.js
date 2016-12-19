function getDetail(n) {
  if (n == 1) return [[1]];
  if (n == 2) return [[1,1], [2]];
  if (n == 3) return [[1,1,1], [1,2], [2,1], [3]];

  // 获取n-d情况下的所有方案，然后在前面都加一个d，获得n情况下第一次跑了d圈再进站的所有情况，d=1,2,3
  function getPrefixedDetail(d) {
    return getDetail(n - d).map(function(i) { return [d].concat(i); });
  }
  return getPrefixedDetail(1).concat(getPrefixedDetail(2)).concat(getPrefixedDetail(3));
}

console.log(getDetail(5))