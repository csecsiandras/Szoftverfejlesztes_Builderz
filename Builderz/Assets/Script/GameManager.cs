using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;

public class Block
{
    public Transform blockTransform;
}

public enum BlockColor
{
    Red = 0,
    White = 1,
    Green = 2,
    Blue = 3,
    Black = 4

}

public class GameManager : MonoBehaviour
{
    private float blockSize = 0.25f;

    public Block[,,] blocks = new Block[20, 20, 20];
    public GameObject blockPrefab;

    public BlockColor selectedColor;
    public Material[] blockMaterials;

    private GameObject foundationObject;
    private Vector3 blockOffset;
    private Vector3 foundationCenter = new Vector3(1.25f, 0, 1.25f);

    private void Start()
    {
        foundationObject = GameObject.Find("Foundation");
        blockOffset = (Vector3.one* 0.5f) / 4;
        selectedColor = BlockColor.White;
    }

    private void Update()
    {
        if(Input.GetMouseButtonDown(0))
        {
            RaycastHit hit;
            if (Physics.Raycast(Camera.main.ScreenPointToRay(Input.mousePosition), out hit, 30.0f)) 
            {
                
                Vector3 index = BlockPosition(hit.point);

                int x = (int)index.x
                    , y = (int)index.y
                    , z = (int)index.z;

                if(blocks[x,y,z] == null)
                {
                    GameObject go = CreateBlock();
                    go.transform.localScale = Vector3.one * blockSize;

                    PostitionBlock(go.transform, index);

                    blocks[x, y, z] = new Block
                    {
                        blockTransform = go.transform
                    };
                }
                else
                {
                    GameObject go = CreateBlock();
                    go.transform.localScale = Vector3.one * blockSize;

                    Vector3 newIndex = BlockPosition(hit.point + (hit.normal * blockSize));
                    PostitionBlock(go.transform, newIndex);

                 // Debug.Log("Error: clicking inside of a cube at position " + index.ToString());
                }
            }
        }
    }

    private Vector3 BlockPosition(Vector3 hit)
    {
        int x = (int)(hit.x / blockSize);
        int y = (int)(hit.y / blockSize);
        int z = (int)(hit.z / blockSize);

        //Transform world point into block array
        //Vector3 fnd = foundationObject.transform.position - foundationCenter;
        //float x = (int)(hit.x + fnd.x);
        //float y = (int)(hit.y + fnd.y);
        //float z = (int)(hit.z + fnd.z);

        return new Vector3(x, y, z);
    }

    private GameObject CreateBlock()
    {
        GameObject go = Instantiate(blockPrefab) as GameObject;
        go.GetComponent<Renderer>().material = blockMaterials[(int)selectedColor];
        return go;
    }

    private void PostitionBlock(Transform t, Vector3 index)
    {
        t.position = ((index * blockSize) + blockOffset) 
            + (foundationObject.transform.position - foundationCenter);
    }

    public void ChangeBlockColor(int color)
    {
        selectedColor = (BlockColor)color;


        /*BlockColor c = (BlockColor)color;
        switch(c)
        {
            case BlockColor.Red: //Red
                break;
            case BlockColor.White: //White
                break;
            case BlockColor.Green: //Green
                break;
            case BlockColor.Blue: //Blue
                break;
            case BlockColor.Black: //Black
                break;
        }*/
    }
}
