# DBSCAN  密度的聚类算法

> 参考 http://www.jianshu.com/p/e8dd62bec026

DBSCAN算法中将数据点分为一下三类：

1.  核心点。在半径Eps内含有超过MinPts数目的点
2.  边界点。在半径Eps内点的数量小于MinPts，但是落在核心点的邻域内
3.  噪音点。既不是核心点也不是边界点的点


DBSCAN算法的显著优点是聚类能够有效处理噪声点和发现任意形状的空间聚类.

# DBSCAN 下的第三个参数 距离对象算法

1. 欧几里德距离(默认) - Euclidean

```
    欧几里德算法又称辗转相除法，是指用于计算两个正整数a，b的最大公约数。应用领域有数学和计算机两个方面。
    
    计算公式gcd(a,b) = gcd(b,a mod b)。
    
    
```
  PHP-ML 中的 应用 如 [欧几里德距离](./euclidean.php)
