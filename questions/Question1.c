#include <stdio.h>
#include <string.h>
#include <math.h>
#include <stdlib.h>
#include <ctype.h>

int main() 
{
    char a[1000]={'l','w','4','n','8','8','j','1','2','n','1'};
    int c,num[10] = {0};
    for(int i = 0 ;i <= strlen(a);i++)
    {
        if(isdigit(a[i]) > 0)
        {
            c = (a[i])-'0';
            num[c] += 1;
        }
    }
    for(int i = 0; i<10;i++)
    {
        printf("%d ",num[i]);
    }
    return 0;
}